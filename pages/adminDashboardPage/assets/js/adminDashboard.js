function showCategory(category) {
  const userTable = document.getElementById("users");
  const deliveryTable = document.getElementById("deliveries");

  if (userTable) userTable.style.display = "none";
  if (deliveryTable) deliveryTable.style.display = "none";

  if (category === "users" && userTable) {
    userTable.style.display = "table";
  } else if (category === "deliveries" && deliveryTable) {
    deliveryTable.style.display = "table";
  }
}
