function showContent(id) {
  const allTabs = document.querySelectorAll(".tab-content");
  allTabs.forEach((tab) => (tab.style.display = "none"));

  const selected = document.getElementById(id);
  if (selected) selected.style.display = "block";
}
