const imagesNumber = document.getElementById('images-number')
const imagesCont = document.getElementById('images-cont')
const fileInput = document.getElementById('file')

function preview() {
    imagesCont.innerHTML = ""
    imagesNumber.textContent = `${fileInput.files.length}`

    for(i of fileInput.files) {
        let reader = new FileReader()

        let figure = document.createElement('figure')
        figure.style.display = 'flex';
        let figCap = document.createElement('figcaption')

        figCap.innerText = ''
        figure.appendChild(figCap)

        reader.onload=()=>{
            let img = document.createElement('img')
            img.style.height = '100px';
            img.style.width = '150px';
            img.style.borderRadius = '10px';
            img.setAttribute('src', reader.result)
            figure.insertBefore(img, figCap)
        }
        imagesCont.appendChild(figure)
        reader.readAsDataURL(i)
    }
}