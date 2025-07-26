function scrollCourier(amount) {
  const container = document.querySelector(".courier-pick");
  container.scrollBy({
    top: amount,
    behavior: "smooth",
  });
}

document.addEventListener("DOMContentLoaded", function () {
  const courierContainers = document.querySelectorAll(".courier-container");
  const addDeliveryForm = document.getElementById("addDeliveryForm");
  const courierIdInput = document.getElementById("courier_id");
  const selectedCourierName = document.getElementById("selectedCourierName");

  courierContainers.forEach((container) => {
    const selectBtn = container.querySelector(".select-btn");
    const deselectBtn = container.querySelector(".deselect-btn");
    const courierId = selectBtn.getAttribute("data-courier");
    const courierName = container
      .querySelector(".courier-logo")
      .alt.replace(" Logo", "");

    selectBtn.addEventListener("click", function () {
      courierContainers.forEach((c) => {
        if (c !== container) {
          c.classList.add("grayed-out");
          c.querySelector(".select-btn").style.display = "";
          c.querySelector(".deselect-btn").style.display = "none";
        } else {
          c.classList.remove("grayed-out");
          selectBtn.style.display = "none";
          deselectBtn.style.display = "";
        }
      });
      addDeliveryForm.style.display = "";
      courierIdInput.value = courierId;
      selectedCourierName.textContent = courierName;
    });

    deselectBtn.addEventListener("click", function () {
      courierContainers.forEach((c) => {
        c.classList.remove("grayed-out");
        c.querySelector(".select-btn").style.display = "";
        c.querySelector(".deselect-btn").style.display = "none";
      });
      addDeliveryForm.style.display = "none";
      courierIdInput.value = "";
      selectedCourierName.textContent = "";
    });
  });

    addDeliveryForm.onsubmit = function(e) {
        e.preventDefault();
        const form = e.target;
        const data = new FormData(form);
        fetch('/handlers/deliveries.handler.php?action=add', {
            method: 'POST',
            body: data
        })
        .then(res => res.json())
        .then(result => {
            const deliveryResult = document.getElementById('deliveryResult');
            if (result.success) {
                deliveryResult.textContent = 'Delivery successfully added!';
                deliveryResult.style.color = 'green';
                form.reset();
                setTimeout(() => {
                    window.location.reload();
                    deliveryResult.textContent = '';
                }, 800);
            } else {
                deliveryResult.textContent = 'Failed to add delivery';
                deliveryResult.style.color = 'red';
            }
        });
    };
});
