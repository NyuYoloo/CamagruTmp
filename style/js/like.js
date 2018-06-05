let like = document.querySelectorAll('#all-gal div div img'),
	likeval = document.querySelectorAll('#all-gal div div')

for (let i = 0; i < like.length; i++) {
	like[i].addEventListener("click", function(){likelike(likeval[i].id)});
}

function likelike(val) {
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			let resp = xhr.responseText;
			console.log(resp);
			let span = document.querySelector("#span" + val);
			span.innerText = resp;

		}
	};
	xhr.open('POST', "script/like.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("like=" + val);
}
