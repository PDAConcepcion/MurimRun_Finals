function showCategory(category) {
  const userTable = document.getElementById("users");
  const deliveryTable = document.getElementById("deliveries");
  const sectCouriersTable = document.getElementById("sectcouriers");

  if (userTable) userTable.style.display = "none";
  if (deliveryTable) deliveryTable.style.display = "none";
  if (sectCouriersTable) sectCouriersTable.style.display = "none";

  if (category === "users" && userTable) {
    userTable.style.display = "table";
  } else if (category === "deliveries" && deliveryTable) {
    deliveryTable.style.display = "table";
  } else if (category === "sectcouriers" && sectCouriersTable) {
    sectCouriersTable.style.display = "table";
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const editBtn = document.getElementById("editBtn");
  const deleteBtn = document.getElementById("deleteBtn");
  const userTable = document.getElementById("users");
  const dbTable = document.querySelector('.db-table');

  if (editBtn) {
    editBtn.addEventListener("click", function () {
      const tables = ["users", "deliveries", "sectcouriers"];
      let activeTable = tables.find(t => {
        const el = document.getElementById(t);
        return el && el.style.display !== "none";
      });
      if (!activeTable) return;

      const table = document.getElementById(activeTable);
      const checked = table.querySelectorAll('.select-cell input[type="checkbox"]:checked');
      if (checked.length !== 1) {
        alert("Please select exactly one row to edit.");
        return;
      }
      const row = checked[0].closest("tr");
      const cells = Array.from(row.children).slice(1); // skip checkbox cell

      // Prepare form fields based on table
      let fieldsHtml = "";
      if (activeTable === "users") {
        const labels = ["user_id", "username", "first_name", "last_name", "email", "role"];
        labels.forEach((label, i) => {
          fieldsHtml += `<label>${label}:<input name="${label}" value="${cells[i].textContent.trim()}" ${label === "user_id" ? "readonly" : ""}></label><br>`;
        });
      } else if (activeTable === "deliveries") {
        const labels = ["delivery_id", "user_id", "courier_id", "origin", "destination", "package_description", "status", "delivery_time_estimate", "weight_kg"];
        labels.forEach((label, i) => {
          fieldsHtml += `<label>${label}:<input name="${label}" value="${cells[i].textContent.trim()}" ${label === "delivery_id" ? "readonly" : ""}></label><br>`;
        });
      } else if (activeTable === "sectcouriers") {
        const labels = ["courier_id", "name", "sectname", "rank", "speedrating", "status"];
        labels.forEach((label, i) => {
          if (label === "status") {
            // Only allow true/false
            const current = cells[i].textContent.trim().toLowerCase() === "available" ? "true" : "false";
            fieldsHtml += `<label>${label}: 
              <select name="status">
                <option value="true" ${current === "true" ? "selected" : ""}>Available</option>
                <option value="false" ${current === "false" ? "selected" : ""}>Unavailable</option>
              </select>
            </label><br>`;
          } else {
            fieldsHtml += `<label>${label}:<input name="${label}" value="${cells[i].textContent.trim()}" ${label === "courier_id" ? "readonly" : ""}></label><br>`;
          }
        });
      }

      document.getElementById("editFields").innerHTML = fieldsHtml;
      document.getElementById("editModal").style.display = "block";

      // Submit handler
      document.getElementById("editForm").onsubmit = function(e) {
        e.preventDefault();
        const formData = new FormData(e.target);
        let url = "";
        if (activeTable === "users") {
          url = "/handlers/user.handler.php?action=adminUpdate";
        } else if (activeTable === "deliveries") {
          url = "/handlers/deliveries.handler.php?action=updateById";
        } else if (activeTable === "sectcouriers") {
          url = "/handlers/sectCourier.handler.php?action=updateById";
        }
        fetch(url, {
          method: "POST",
          body: formData
        })
        .then(res => res.json())
        .then(result => {
          if (result.success) {
            alert("Update successful!");
            window.location.reload();
          } else {
            alert("Update failed.");
          }
        })
        .catch(err => {
          alert("Update error: " + err);
        });
      };
    });
  }

  const cancelEditBtn = document.getElementById("cancelEditBtn");
  if (cancelEditBtn) {
    cancelEditBtn.onclick = function() {
      document.getElementById("editModal").style.display = "none";
    };
  }

  if (deleteBtn) {
    deleteBtn.addEventListener("click", function () {
      const tables = ["users", "deliveries", "sectcouriers"];
      let activeTable = tables.find(t => {
        const el = document.getElementById(t);
        return el && el.style.display !== "none";
      });
      if (!activeTable) return;

      const table = document.getElementById(activeTable);
      const checked = table.querySelectorAll('.select-cell input[type="checkbox"]:checked');
      if (checked.length === 0) return;

      const ids = Array.from(checked).map(cb => cb.value);

      // For users and sectcouriers, check for related deliveries first
      if (activeTable === "users" || activeTable === "sectcouriers") {
        let checkUrl = "";
        let checkBody = new FormData();
        if (activeTable === "users") {
          checkUrl = "/handlers/user.handler.php?action=checkDelete";
          ids.forEach(id => checkBody.append("user_ids[]", id));
        } else {
          checkUrl = "/handlers/sectCourier.handler.php?action=checkDelete";
          ids.forEach(id => checkBody.append("courier_ids[]", id));
        }
        fetch(checkUrl, {
          method: "POST",
          body: checkBody
        })
        .then(res => res.json())
        .then(result => {
          let proceed = true;
          if (result.hasDeliveries) {
            proceed = confirm(`Warning: Deleting will also remove ${result.deliveriesCount} related deliveries. Continue?`);
          } else {
            proceed = confirm(`Are you sure you want to delete the selected ${activeTable}?`);
          }
          if (!proceed) return;

          // Now actually delete
          let url = "";
          let body = new FormData();
          if (activeTable === "users") {
            url = "/handlers/user.handler.php?action=delete";
            ids.forEach(id => body.append("user_ids[]", id));
          } else {
            url = "/handlers/sectCourier.handler.php?action=delete";
            ids.forEach(id => body.append("courier_ids[]", id));
          }
          fetch(url, {
            method: "POST",
            body: body
          })
          .then(res => res.json())
          .then(result => {
            if (result.success) {
              checked.forEach(cb => cb.closest("tr").remove());
              updateActionButtonsVisibility();
            } else {
              alert("Failed to delete selected items.");
            }
          })
          .catch(err => {
            alert("Failed to delete: " + err);
          });
        });
        return;
      }

      // For deliveries, just delete directly
      let url = "/handlers/deliveries.handler.php?action=delete";
      let body = new FormData();
      ids.forEach(id => body.append("delivery_ids[]", id));
      if (!confirm(`Are you sure you want to delete the selected deliveries?`)) return;
      fetch(url, {
        method: "POST",
        body: body
      })
      .then(res => res.json())
      .then(result => {
        if (result.success) {
          checked.forEach(cb => cb.closest("tr").remove());
          updateActionButtonsVisibility();
        } else {
          alert("Failed to delete selected items.");
        }
      })
      .catch(err => {
        alert("Failed to delete: " + err);
      });
    });
  }

  function updateActionButtonsVisibility() {
    const checkedBoxes = dbTable.querySelectorAll('input[type="checkbox"]:checked');
    if (editBtn) editBtn.style.display = "";
    if (deleteBtn) deleteBtn.style.display = "";
  }

  dbTable.addEventListener('change', function (e) {
    if (e.target.type === "checkbox") updateActionButtonsVisibility();
  });

  updateActionButtonsVisibility();
});