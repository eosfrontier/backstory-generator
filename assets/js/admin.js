document.addEventListener("DOMContentLoaded", function () {
	$('#existing-backstory-textarea').trumbowyg({
		plugins: {
			colors: {
				colorList: [
					'ffffff', '000000', 'eeece1', '1f497d', '4f81bd', 'c0504d', '9bbb59', '8064a2', '4bacc6', 'f79646', 'ffff00',
					'f2f2f2', '7f7f7f', 'ddd9c3', 'c6d9f0', 'dbe5f1', 'f2dcdb', 'ebf1dd', 'e5e0ec', 'dbeef3', 'fdeada', 'fff2ca',
					'd8d8d8', '595959', 'c4bd97', '8db3e2', 'b8cce4', 'e5b9b7', 'd7e3bc', 'ccc1d9', 'b7dde8', 'fbd5b5', 'ffe694',
					'bfbfbf', '3f3f3f', '938953', '548dd4', '95b3d7', 'd99694', 'c3d69b', 'b2a2c7', 'b7dde8', 'fac08f', 'f2c314',
					'a5a5a5', '262626', '494429', '17365d', '366092', '953734', '76923c', '5f497a', '92cddc', 'e36c09', 'c09100',
					'7f7f7f', '0c0c0c', '1d1b10', '0f243e', '244061', '632423', '4f6128', '3f3151', '31859b', '974806', '7f6000'
				]
			}
		},
		btns: [
			['viewHTML'],
			['undo', 'redo'], // Only supported in Blink browsers
			['formatting'],
			['strong', 'em', 'del'],
			['superscript', 'subscript'],
			['link'],
			['insertImage'],
			['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
			['unorderedList', 'orderedList'],
			['horizontalRule'],
			['removeformat'],
			['fullscreen'],
			['foreColor', 'backColor']
		],
		autogrow: true
	});

	var editButtons = document.querySelectorAll(".concept_change-request-button");
	if (editButtons) {
		editButtons.forEach((editButton) => {
			editButton.addEventListener("click", function () {
				const id = this.id.replace("concept-changes-button-", "");
				const conceptChangesForm = document.querySelector("#concept-changes-" + id);
				const conceptApproveButton = document.querySelector("#concept-approve-button-" + id);


				$("#concept_changes-form-" + id).trumbowyg({
					plugins: {
						colors: {
							colorList: [
								'ffffff', '000000', 'eeece1', '1f497d', '4f81bd', 'c0504d', '9bbb59', '8064a2', '4bacc6', 'f79646', 'ffff00',
								'f2f2f2', '7f7f7f', 'ddd9c3', 'c6d9f0', 'dbe5f1', 'f2dcdb', 'ebf1dd', 'e5e0ec', 'dbeef3', 'fdeada', 'fff2ca',
								'd8d8d8', '595959', 'c4bd97', '8db3e2', 'b8cce4', 'e5b9b7', 'd7e3bc', 'ccc1d9', 'b7dde8', 'fbd5b5', 'ffe694',
								'bfbfbf', '3f3f3f', '938953', '548dd4', '95b3d7', 'd99694', 'c3d69b', 'b2a2c7', 'b7dde8', 'fac08f', 'f2c314',
								'a5a5a5', '262626', '494429', '17365d', '366092', '953734', '76923c', '5f497a', '92cddc', 'e36c09', 'c09100',
								'7f7f7f', '0c0c0c', '1d1b10', '0f243e', '244061', '632423', '4f6128', '3f3151', '31859b', '974806', '7f6000'
							]
						}
					},
					btns: [
						['viewHTML'],
						['undo', 'redo'], // Only supported in Blink browsers
						['formatting'],
						['strong', 'em', 'del'],
						['superscript', 'subscript'],
						['link'],
						['insertImage'],
						['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
						['unorderedList', 'orderedList'],
						['horizontalRule'],
						['removeformat'],
						['fullscreen'],
						['foreColor', 'backColor']
					],
					autogrow: true
				});
				this.style.display = "none";
				conceptChangesForm.style.display = "block";
				conceptApproveButton.style.display = "none";

			});
		});
	}

	var approveButtons = document.querySelectorAll(".concept_approve-button");
	if (approveButtons) {
		approveButtons.forEach((approveButton) => {
			approveButton.addEventListener("click", function () {
				const id = this.id.replace("concept-approve-button-", "");
				const conceptApproveForm = document.querySelector("#concept-approve-" + id);
				const conceptRequestChangeButton = document.querySelector("#concept-changes-button-" + id);

				$("#concept_comment-form-" + id).trumbowyg({
					plugins: {
						colors: {
							colorList: [
								'ffffff', '000000', 'eeece1', '1f497d', '4f81bd', 'c0504d', '9bbb59', '8064a2', '4bacc6', 'f79646', 'ffff00',
								'f2f2f2', '7f7f7f', 'ddd9c3', 'c6d9f0', 'dbe5f1', 'f2dcdb', 'ebf1dd', 'e5e0ec', 'dbeef3', 'fdeada', 'fff2ca',
								'd8d8d8', '595959', 'c4bd97', '8db3e2', 'b8cce4', 'e5b9b7', 'd7e3bc', 'ccc1d9', 'b7dde8', 'fbd5b5', 'ffe694',
								'bfbfbf', '3f3f3f', '938953', '548dd4', '95b3d7', 'd99694', 'c3d69b', 'b2a2c7', 'b7dde8', 'fac08f', 'f2c314',
								'a5a5a5', '262626', '494429', '17365d', '366092', '953734', '76923c', '5f497a', '92cddc', 'e36c09', 'c09100',
								'7f7f7f', '0c0c0c', '1d1b10', '0f243e', '244061', '632423', '4f6128', '3f3151', '31859b', '974806', '7f6000'
							]
						}
					},
					btns: [
						['viewHTML'],
						['undo', 'redo'], // Only supported in Blink browsers
						['formatting'],
						['strong', 'em', 'del'],
						['superscript', 'subscript'],
						['link'],
						['insertImage'],
						['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
						['unorderedList', 'orderedList'],
						['horizontalRule'],
						['removeformat'],
						['fullscreen'],
						['foreColor', 'backColor']
					],
					autogrow: true
				});
				this.style.display = "none";
				conceptApproveForm.style.display = "block";
				conceptRequestChangeButton.style.display = "none";
			});
		});
	}


	var tabButtons = document.querySelectorAll(".tab-list button");

	tabButtons.forEach((button) => {
		button.addEventListener("click", function (e) {
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

	var contentToggles = document.querySelectorAll(".mouse_hover");

	contentToggles.forEach((button) => {
		button.addEventListener("click", function (e) {
			if (e.target.classList.contains("active")) {
				this.classList.remove("active");
				button.nextElementSibling.classList.remove("show");
			} else {
				this.classList.add("active");
				button.nextElementSibling.classList.add("show");
			}
		})
	});
});
function switchFactionBlurb(factionName) {
	var target = $('.factionblurb');
	if (factionName == "*") {
		$(".fct_aquila").fadeIn();
		$(".fct_dugo").fadeIn();
		$(".fct_ekanesh").fadeIn();
		$(".fct_pendzal").fadeIn();
		$(".fct_sona").fadeIn();
		$(".fct_selector").fadeIn();
		return true;
	}
	else if (target.html() != "" && factionName && factionName != "") {
		target.hide();

		$(".fct_" + factionName).fadeIn();
		$(".fct_selector").fadeIn();

		return true;
	}
	var target2 = $('.factionselector');
	if (factionName == "*") {
		$(".fct_aquila").fadeIn();
		$(".fct_dugo").fadeIn();
		$(".fct_ekanesh").fadeIn();
		$(".fct_pendzal").fadeIn();
		$(".fct_sona").fadeIn();
		$(".fct_selector").fadeIn();
		return true;
	}
	else if (target2.html() != "" && factionName && factionName != "") {
		target2.hide();

		$(".fct_" + factionName).fadeIn();
		$(".fct_selector").fadeIn();

		return true;
	}
}
