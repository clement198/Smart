// Comment 

const comment_form = document.querySelector(".comment"),
    sndBtn = comment_form.querySelector(".snd_comment");

sndBtn.onclick = () => {
    const xml = new XMLHttpRequest();
    xml.open("POST", "../backend/insert_comment_back.php", true);
    const formData = new FormData(comment_form);
    xml.send(formData);
}