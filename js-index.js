var nameInput = document.getElementById("name-input"),
	messageInput = document.getElementById("message-input"),
	messageBoxInput = document.getElementById("message-box-input"),
	userfromInput = document.getElementById("userfrom-input");

let params = new URLSearchParams(window.location.search)

$(`#${params.get('user_to')}-message-box`).scrollTop($(`#${params.get('user_to')}-message-box`)[0].scrollHeight);

function handleKeyUp(e) {
	if (e.keyCode === 13) {
		sendMessage();
	}
}
function sendMessage() {
	var name = nameInput.value.trim(),
		message = messageInput.value.trim(),
		messageBox = messageBoxInput.value.trim(),
		userfrom = userfromInput.value.trim();

	if (!name)
		return alert("Please fill in the name");

	if (!message)
		return alert("Please write a messageeeeee");

	if (!userfrom)
		return alert("No user");

	var ajax = new XMLHttpRequest();
	ajax.open("POST", "php-send-message.php", true);
	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajax.send("name=" + name + "&message=" + message + "&message_box=" + messageBox + "&userfrom=" + userfrom);

	messageInput.value = "";
}

// Pusher Credentials
const cluster = '';
const auth_key = '';
const secret = '';
const chanel_name = ''

// Pusher
var pusher = new Pusher(auth_key, {
	cluster,
	encrypted: true
}).subscribe(chanel_name);

pusher.bind('message_sent',
	function(data) {
		let currentUser = $('#current_user').val();
		let currentConnect = $('#current_connect').val();
		let chatUsers = data.message_box.split('-')
		if(chatUsers.indexOf(currentUser) !== -1) {
            if ($(`.${data.message_box}-message-box`)[0]) {
				$(`.${data.message_box}-message-box`).append(
					`<div class="message-bubble ${data.user_from !== params.get('user_to') && 'me'}">
				<span class="message-text">${data.message}</span>
				<div class="message-avatar"><img src="assets/images/profile_pics/defaults/profileimg.png"></div>
			</div>`
				).scrollTop($(`.${data.message_box}-message-box`)[0].scrollHeight);
			}

			$.ajax({
				url: 'update_connects_list.php',
				data: {currentUser},
				method: 'post',
				success: (data) => {
					let messagesInbox = $('.messages-inbox ul')
					messagesInbox.html('')
					let updatedConnects = JSON.parse(data)
					updatedConnects.map(function (c) {
						messagesInbox.append(`
						<li class="${+currentConnect === +c.userId ? 'active-message' : ''}">
							<a href="messages.php?user_to=${c.userId}">
								<div class="message-avatar"><i class="status-icon status-online"></i><img
											src="${c.profilePic}" alt=""/>
								</div>

								<div class="message-by">
									<div class="message-by-headline">
										<h5>${c.firstAndLastName}</h5>
										<span><?= $user->${c.lastMessageInfo.sent_on} ago</span>
									</div>
									<p>${c.lastMessageInfo.body}</p>
								</div>
							</a>
						</li>
					`)
					})
				}
			})
		}
	});

setInterval(() => {
	let connectedUsers = $('#connected_users').val().trim().split(' ');
	$.ajax({
		url: 'users_online.php',
		data: {connectedUsers},
		method: 'post',
		success: (data) => {
			let users = JSON.parse(data)
			users.map(u => {
				u.is_online ? $(`#user_${u.user_id}_status`).addClass('status-online') : $(`#user_${u.user_id}_status`).removeClass('status-online')
			})
		}
	})
},30000)