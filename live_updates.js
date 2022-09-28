// Pusher Credentials
const cluster = '';
const auth_key = '';
const secret = '';
const chanel_name = ''

// Pusher
var pusher = new Pusher(auth_key, {
    cluster,
    encrypted: true
}).subscribe('football-app');
pusher.subscribe(`game-updates-${app.game.id}`)
    .bind('event', (data) => {
        app.updates.unshift(data);
    })
    .bind('score', (data) => {
        app.game.first_team_score = data.first_team_score;
        app.game.second_team_score = data.second_team_score;
    });