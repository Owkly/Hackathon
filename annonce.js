window.onload = function() {
    var imageInput = document.getElementById('image-input');
    var textInput = document.getElementById('text-input');
    var textInput2 = document.getElementById('text-input2'); 
    var textInput3 = document.getElementById('text-input3'); 
    var submitButton = document.getElementById('submit-button');
    var deleteButton = document.getElementById('delete-button');
    var contentDisplay = document.getElementById('content-display');

    var storedImageUrls = JSON.parse(localStorage.getItem('imageUrls')) || [];
    var storedTexts = JSON.parse(localStorage.getItem('texts')) || [];
    var storedTexts2 = JSON.parse(localStorage.getItem('texts2')) || []; 
    var storedTexts3 = JSON.parse(localStorage.getItem('texts3')) || []; 

    storedImageUrls.forEach((imageUrl, i) => {
        addContentToDisplay(imageUrl, storedTexts[i], storedTexts2[i]); 
    });

    submitButton.onclick = function() {
        var text = textInput.value;
        var text2 = textInput2.value; 
        var text3 = textInput3.value; 
        storedTexts.push(text);
        storedTexts2.push(text2); 
        storedTexts3.push(text3); 
        localStorage.setItem('texts', JSON.stringify(storedTexts));
        localStorage.setItem('texts2', JSON.stringify(storedTexts2)); 
        localStorage.setItem('texts3', JSON.stringify(storedTexts3)); 

        // Sauvegarder et afficher l'image
        var file = imageInput.files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            var imageUrl = reader.result;
            storedImageUrls.push(imageUrl);
            localStorage.setItem('imageUrls', JSON.stringify(storedImageUrls));
            addContentToDisplay(imageUrl, text, text2, text3); 
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    deleteButton.onclick = function() {
        // Supprimer les données stockées et réinitialiser les affichages
        localStorage.removeItem('texts');
        localStorage.removeItem('texts2'); 
        localStorage.removeItem('texts3'); 
        localStorage.removeItem('imageUrls');
        contentDisplay.innerHTML = ''; 
    }
    

    function addContentToDisplay(imageUrl, text, text2, text3) { 
        var imgElement = document.createElement('img');
        imgElement.src = imageUrl;
        imgElement.className = 'content-image';
    
        var pElement = document.createElement('p');
        pElement.innerText = 'Contact : '+ text;
        pElement.className = 'content-text';
    
        var pElement2 = document.createElement('p'); 
        pElement2.innerText = 'Produit : ' +text2;
        pElement2.className = 'content-text';

        var pElement3 = document.createElement('p'); 
        pElement3.innerText = 'Echange/Prix : ' +text3;
        pElement3.className = 'content-text';
    
        contentDisplay.appendChild(imgElement);
        contentDisplay.appendChild(pElement);
        contentDisplay.appendChild(pElement2); 
        contentDisplay.appendChild(pElement3); 
    }
    
}
