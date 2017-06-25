function addProduct() {
    var type = document.getElementById('type_id').value;
    var brand = document.getElementById('brand_id').value;
    var model = document.getElementById('model_id').value;

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            if (request.status == 201) {
                alert('Product created');
            }
        }
    };
    request.open('POST', 'product-system/scriptProduct.php');
    request.setRequestHeader('Content-Type',
        'application/x-www-form-urlencoded');

    var params = [
        `type=${type}`,
        `brand=${brand}`,
        `model=${model}`
    ];

    request.send(params.join('&'));

}

function addComputer() {

    var name = document.getElementById('name_id').value;
    var cpu = document.getElementById('cpu_id').value;
    var gpu = document.getElementById('gpu_id').value;
    var ram = document.getElementById('ram_id').value;
    var brand = document.getElementById('brand_id').value;

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            if (request.status == 200) {
                alert('Computer created');
            }
        }
    };
    request.open('POST', 'product-system/scriptComputer.php');
    request.setRequestHeader('Content-Type',
        'application/x-www-form-urlencoded');

    var params = [
        `name=${name}`,
        `cpu=${cpu}`,
        `gpu=${gpu}`,
        `ram=${ram}`,
        `brand=${brand}`
    ];

    request.send(params.join('&'));

}

function displayProduct() {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            if (request.status == 200) {
                var products = JSON.parse(request.responseText);

                var table = document.getElementsByTagName("table")[0];
                var tr = document.createElement("tr");
                var td = document.createElement("td");

                td.innerHTML = products;

                table.appendChild(tr);
                tr.appendChild(td);

            }
        }
    };
    request.open('GET', 'product-system/displayProduct.php');
    request.send();
}