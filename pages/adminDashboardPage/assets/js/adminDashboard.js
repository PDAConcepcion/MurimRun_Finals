function showCategory(category) {
  const userTable = document.getElementById("users");
  const deliveryTable = document.getElementById("deliveries");
    const sectCouriersTable = document.getElementById("sectcouriers");


  if (userTable) {
    userTable.style.display = "none";

    // hide/disable user checkboxes
    const headers = userTable.querySelectorAll(".select-header");
    const cells = userTable.querySelectorAll(".select-cell");
    const boxes = userTable.querySelectorAll(".select-cell input");
    headers.forEach((h) => (h.style.display = "none"));
    cells.forEach((c) => (c.style.display = "none"));
    boxes.forEach((cb) => {
      cb.disabled = true;
      cb.checked = false;
    });
    const selectAll = document.getElementById("selectAll");
    if (selectAll) {
      selectAll.disabled = true;
      selectAll.checked = false;
    }
  }

  if (deliveryTable) {
    deliveryTable.style.display = "none";
  }

  if (sectCouriersTable) {
    sectCouriersTable.style.display = "none";
  }

  if (category === "users" && userTable) {
    userTable.style.display = "table";
  } else if (category === "deliveries" && deliveryTable) {
    deliveryTable.style.display = "table";
  } else if (category === "sectcouriers" && sectCouriersTable) {
    sectCouriersTable.style.display = "table";
  }
}

//for add/delete button function

document.addEventListener("DOMContentLoaded", function () {
  const addBtn = document.getElementById("addBtn");
  const deleteBtn = document.getElementById("deleteBtn");
  const selectAll = document.getElementById("selectAll");
  const userTable = document.getElementById("users");

  function toggleCheckboxes(show) {
    const headers = userTable.querySelectorAll(".select-header");
    const cells = userTable.querySelectorAll(".select-cell");
    const checkboxes = userTable.querySelectorAll(".select-cell input");

    headers.forEach((header) => (header.style.display = show ? "" : "none"));
    cells.forEach((cell) => (cell.style.display = show ? "" : "none"));
    checkboxes.forEach((cb) => (cb.disabled = !show));

    if (selectAll) {
      selectAll.disabled = !show;
      selectAll.checked = false;
    }
  }

  addBtn.addEventListener("click", () => {
    toggleCheckboxes(true);
  });

  deleteBtn.addEventListener("click", () => {
    toggleCheckboxes(true);
  });

  if (selectAll) {
    selectAll.addEventListener("change", function () {
      const checkboxes = userTable.querySelectorAll(
        ".select-cell input:not(:disabled)"
      );
      checkboxes.forEach((cb) => {
        cb.checked = this.checked;
      });
    });
  }
});
