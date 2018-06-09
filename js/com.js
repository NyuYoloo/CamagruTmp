let text = document.getElementById('comment'),
	button = document.getElementById('subCom'),
	main = document.getElementById('mainCom');

button.addEventListener('click', function() {sendComment()})

function sendComment() {
	let value = text.value;
	if (value.length > 0) {
		let xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
			{
				let resp = xhr.responseText;
				let div1 = document.createElement('div')
				div1.className = "prems"
				let div2 = document.createElement('div')
				div2.className = "sec"
				let div3 = document.createElement('div')
				div3.className = "trois"
				div3.innerText = resp
				div2.appendChild(div3)
				div1.appendChild(div2)
				main.appendChild(div1)
			}
		}
		xhr.open("POST", "script/com.php", false);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		test = xhr.send('comment=' + value);
	}
}
