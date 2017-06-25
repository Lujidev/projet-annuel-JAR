/**
*
* @author : Ronan Sgaravatto
* 
* Ce fichier regroupe toutes les fonctions qui permettent 
* l'interaction entre l'utilisateur et le config-o-matik
*
**/

function truncateDiv (div){
    div.innerHTML = '';
}

function createTitle (container){
    var div = document.getElementById(container);
    
    var title = document.createElement("h4");
    title.innerHTML = container;
    div.appendChild(title);
}

function loadDbElement (elem, filter = 0){
    var request = new XMLHttpRequest();
    request.onreadystatechange = function (){
	if (request.readyState == 4){
	    if (request.status == 200){
		var comps = JSON.parse( request.responseText );
		addCompToHtml(comps, elem);
	    }
	}
    };
    request.open("GET", "loadElement.php?elem="+elem+"&filter="+filter);
    request.send();
}

function addCompToHtml (comps, container) {
    var div = document.getElementById(container);
    truncateDiv (div);
    createTitle(container);

    var select = document.createElement("select");
    var toAdd = comps.map(transformToHtml); 
    toAdd.forEach(function (add){ select.appendChild(add); });
    div.appendChild(select);
    
    var addButton = document.createElement ("button");
    addButton.innerHTML = "Ajouter";
    addButton.onclick = function(){selectComp(container, select)};
    div.appendChild(addButton);
}

function transformToHtml (comp){
    var option = document.createElement('option');
    option.innerHTML = `${comp.brand} ${comp.comp_name} ${comp.description} ${comp.price}€`;
    option.value = parseFloat(comp.price);
    option.label = parseInt(comp.id);
    return option;
}

function selectComp(container, select){
    var div = document.getElementById(container);
    truncateDiv (div);
    createTitle(container);

    /*option selectionnée*/
    var selected = select.options[select.selectedIndex];
    
    var comp = document.createElement("span");
    comp.innerHTML = selected.text;
    comp.setAttribute ("value", selected.label);
    comp.setAttribute ("class", "choice");
    div.appendChild(comp);

    var remButton = document.createElement("button");
    remButton.onclick = function (){ removeComp (container, selected.value); };
    remButton.innerHTML = 'X';
    div.appendChild(remButton);
    
    updatePrice (selected.value);
}

function removeComp(container, minusPrice){
    var div = document.getElementById(container);
    truncateDiv (div);
    createTitle(container);

    var addimg = document.createElement("img");
    addimg.src = "empty.png";
    addimg.width = "32";
    addimg.onclick = function() { loadDbElement(container, 0); }
    div.appendChild (addimg);

    var span = document.createElement("span");
    span.setAttribute ("class", "choice");
    div.appendChild(span);

    var price = parseFloat(minusPrice) * -1;
    updatePrice (price);
}

function updatePrice (newPrice){
    var total = document.getElementById("price");
    var cur_price = total.getAttribute('value');
    var price = parseFloat(cur_price) + parseFloat(newPrice);

    total.innerHTML = `Total : ${price}€`;
    total.setAttribute('value', price);
}

/*to do*/
function updateFilter (){
    var spans = document.getElementsByClassName("choice");
}
