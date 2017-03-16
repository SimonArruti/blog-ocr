// Comments

let button = document.getElementsByClassName("reply")
let form = document.getElementById("form-comment-reply")

let insertAfter = function (referenceNode, newNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}



Array.from(button).forEach(function(element) {
    element.addEventListener('click', function (evt) {
        evt.preventDefault()

        document.getElementById("reply_id").value = element.dataset.id

        insertAfter(element.parentNode, form)

        form.style.display = "block"
    });
});