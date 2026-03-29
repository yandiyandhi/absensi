let video = document.getElementById("camera");

// Akses kamera saat halaman dibuka
navigator.mediaDevices
    .getUserMedia({
        video: {
            facingMode: "user",
        },
        audio: false,
    })
    .then((stream) => {
        video.srcObject = stream;
    })
    .catch((err) => {
        alert("Kamera tidak bisa diakses: " + err.message);
    });

// Saat submit → auto capture
document.getElementById("formKamera").addEventListener("submit", function (e) {
    const canvas = document.getElementById("canvas");
    const fotoInput = document.getElementById("foto");

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    const ctx = canvas.getContext("2d");
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    // Simpan ke base64
    const dataUrl = canvas.toDataURL("image/png");
    fotoInput.value = dataUrl;
});
