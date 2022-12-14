function getPlantes(inputName) {
	let input = document.getElementById(`${inputName}`);
	let receiver = document.getElementById("plantes-tbody");
	let value = input.value;
	const xhr = new XMLHttpRequest();
	xhr.open("POST", "/pages/plantes/php/get_plantes.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onload = () => {
		if (xhr.status === 200 && xhr.readyState === 4) {
			receiver.innerHTML = xhr.responseText;
		} else if (xhr.readyState === 4) {
			console.log("Error occured");
		}
	};
	xhr.send(`table=${inputName}&val=${value}`);
}
