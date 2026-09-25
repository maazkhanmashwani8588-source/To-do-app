const ClearForm = document.getElementById("clear");

ClearForm.addEventListener("submit",function(e) {
	
const yesSubmit = confirm("Are you sure you want to DELETE ALL tasks?");

if (!yesSubmit) {
	e.preventDefault();
}

	
});