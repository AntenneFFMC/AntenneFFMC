var FtpDeploy = require('ftp-deploy');
var ftpDeploy = new FtpDeploy();
 
var config = {
    user: "preprod.ffmc73.ft",
    password: "#Gatogorbo73",         // optional, prompted if none given
    host: "ftp.ouvaton.coop",
    port: 21,
    localRoot: __dirname + '/squelettes',
    remoteRoot: '/httpdocs/squelettes/',
    include: ['main.css'],
    exclude: [],                     // e.g. exclude sourcemaps - ** exclude: [] if nothing to exclude **
    deleteRemote: false,             // delete ALL existing files at destination before uploading, if true
    forcePasv: true                  // Passive mode is forced (EPSV command is not sent)
}
 
 // use with promises
ftpDeploy.deploy(config)
    .then(res => console.log('finished:', res))
    .catch(err => console.log(err))