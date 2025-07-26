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
  const editModal = document.getElementById("editModal");
  const editForm = document.getElementById("editForm");
  const editCancelBtn = document.getElementById("editCancelBtn");
  const deleteBtn = document.getElementById("deleteBtn");
  const selectAll = document.getElementById("selectAll");
  const userTable = document.getElementById("users");

  // Edit button always visible
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
      if (checked.length !== 1) return;

      const row = checked[0].closest("tr");
      const cells = row.querySelectorAll("td");

      document.querySelector('.edit-user-fields').style.display = "none";
      document.querySelector('.edit-sectcourier-fields').style.display = "none";
      document.querySelector('.edit-delivery-fields').style.display = "none";

      if (activeTable === "users") {
        document.querySelector('.edit-user-fields').style.display = "";
        document.getElementById("edit_user_id").value = cells[1].textContent.trim();
        document.getElementById("edit_username").value = cells[2].textContent.trim();
        document.getElementById("edit_first_name").value = cells[3].textContent.trim();
        document.getElementById("edit_last_name").value = cells[4].textContent.trim();
        document.getElementById("edit_email").value = cells[5].textContent.trim();
        document.getElementById("edit_role").value = cells[6].textContent.trim();
        editModal.style.display = "flex";
      } else if (activeTable === "sectcouriers") {
        document.querySelector('.edit-sectcourier-fields').style.display = "";
        document.getElementById("edit_courier_id").value = cells[1].textContent.trim();
        document.getElementById("edit_name").value = cells[2].textContent.trim();
        document.getElementById("edit_sectname").value = cells[3].textContent.trim();
        document.getElementById("edit_rank").value = cells[4].textContent.trim();
        document.getElementById("edit_speedrating").value = cells[5].textContent.trim();
        document.getElementById("edit_status").value = cells[6].textContent.trim() === "Available" ? "true" : "false";
        editModal.style.display = "flex";
      } else if (activeTable === "deliveries") {
        document.querySelector('.edit-delivery-fields').style.display = "";
        document.getElementById("edit_delivery_id").value = cells[1].textContent.trim();
        document.getElementById("edit_delivery_user_id").value = cells[2].textContent.trim();
        document.getElementById("edit_delivery_courier_id").value = cells[3].textContent.trim();
        document.getElementById("edit_origin").value = cells[4].textContent.trim();
        document.getElementById("edit_destination").value = cells[5].textContent.trim();
        document.getElementById("edit_package_description").value = cells[6].textContent.trim();
        document.getElementById("edit_delivery_status").value = cells[7].textContent.trim();
        document.getElementById("edit_delivery_time_estimate").value = cells[8].textContent.trim();
        document.getElementById("edit_weight_kg").value = cells[9].textContent.trim();
        editModal.style.display = "flex";
      }
    });
  }

  if (editCancelBtn) {
    editCancelBtn.addEventListener("click", function () {
      editModal.style.display = "none";
    });
  }

  if (editForm) {
    editForm.addEventListener("submit", function (e) {
      e.preventDefault();
      const formData = new FormData(editForm);
      let url = "/handlers/user.handler.php?action=updateById";
      const tables = ["users", "deliveries", "sectcouriers"];
      let activeTable = tables.find(t => {
        const el = document.getElementById(t);
        return el && el.style.display !== "none";
      });
      if (activeTable === "sectcouriers") {
        url = "/handlers/sectCourier.handler.php?action=updateById";
      } else if (activeTable === "deliveries") {
        url = "/handlers/deliveries.handler.php?action=updateById";
      }
      fetch(url, {
        method: "POST",
        body: formData
      })
      .then(res => res.json())
      .then(result => {
        if (result.success) {
          alert("Updated successfully!");
          location.reload();
        } else {
          alert("Failed to update.");
        }
      })
      .catch(err => {
        alert("Error: " + err);
      });
    });
  }

  // Delete button always visible
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
        } else {
          alert("Failed to delete selected items.");
        }
      })
      .catch(err => {
        alert("Failed to delete: " + err);
      });
    });
  }

  if (selectAll) {
    selectAll.addEventListener("change", function () {
      const checkboxes = userTable.querySelectorAll(".select-cell input:not(:disabled)");
      checkboxes.forEach(cb => cb.checked = this.checked);
    });
  }
});