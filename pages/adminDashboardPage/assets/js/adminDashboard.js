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
  const selectAll = document.getElementById("selectAll");
  const userTable = document.getElementById("users");
  const dbTable = document.querySelector('.db-table');

  function toggleCheckboxes(show) {
    const headers = userTable.querySelectorAll(".select-header");
    const cells = userTable.querySelectorAll(".select-cell");
    const checkboxes = userTable.querySelectorAll(".select-cell input");

    headers.forEach(header => header.style.display = show ? "" : "none");
    cells.forEach(cell => cell.style.display = show ? "" : "none");
    checkboxes.forEach(cb => cb.disabled = !show);

    if (selectAll) {
      selectAll.disabled = !show;
      selectAll.checked = false;
    }
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

  if (selectAll) {
    selectAll.addEventListener("change", function () {
      const checkboxes = userTable.querySelectorAll(".select-cell input:not(:disabled)");
      checkboxes.forEach(cb => cb.checked = this.checked);
    });
  }

  function updateActionButtonsVisibility() {
    const checkedBoxes = dbTable.querySelectorAll('input[type="checkbox"]:checked');
    if (editBtn) editBtn.style.display = checkedBoxes.length === 1 ? "" : "none";
    if (deleteBtn) deleteBtn.style.display = checkedBoxes.length > 0 ? "" : "none";
  }

  dbTable.addEventListener('change', function (e) {
    if (e.target.type === "checkbox") updateActionButtonsVisibility();
  });

  updateActionButtonsVisibility();
});