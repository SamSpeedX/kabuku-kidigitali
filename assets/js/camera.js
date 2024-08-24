const camerafid = document.getElementById('camerafid');

navigator.mediaDevices.getUserMedia({ video: true }).then(stream => {
    camerafid.srcObject = stream;
}) .catch( error => {
    console.error('error to access camera')

    })