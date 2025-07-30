document.addEventListener("DOMContentLoaded", () => {
  document.body.addEventListener("click", function (e) {
    if (e.target.classList.contains("cancel-btn")) {
      const btn = e.target;
      if (!confirm("Are you sure you want to cancel this delivery?")) return;
      const deliveryId = btn.getAttribute("data-id");
      fetch("/handlers/deliveries.handler.php?action=cancel", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "delivery_id=" + encodeURIComponent(deliveryId),
      })
        .then((res) => res.json())
        .then((result) => {
          if (result.success) {
            window.location.reload();
          } else {
            alert("Failed to cancel delivery.");
          }
        })
        .catch(() => alert("Error cancelling delivery."));
    }
  });
});