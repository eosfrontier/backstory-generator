document.addEventListener("DOMContentLoaded", function() {
	var tabButtons = document.querySelectorAll(".tab-list button");

	tabButtons.forEach((button) => {
		button.addEventListener("click", function(e) {
			var attribute = this.getAttribute("data-tab");

			if (e.target.className !== "active") {
				var activeTab = document.querySelector(".tab.active");
				var activeButton = document.querySelector(".tab-list button.active");
				var newTab = document.querySelector(".tab[data-tab='" + attribute + "']")

				activeTab.classList.remove("active");
				activeButton.classList.remove("active");

				this.classList.add("active");
				newTab.classList.add("active");
			}
		});
	});
});
