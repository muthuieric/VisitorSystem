//
//Host Select
document.addEventListener('DOMContentLoaded', function() {
var input = document.getElementById('employee-select');
var ul = document.getElementById('employee-list');
var listItems = ul.getElementsByTagName('li');

input.addEventListener('input', function() {
    var inputValue = this.value.toLowerCase();
    for (var i = 0; i < listItems.length; i++) {
        var text = listItems[i].innerText.toLowerCase();
        if (text.indexOf(inputValue) !== -1) {
            listItems[i].style.display = 'block';
        } else {
            listItems[i].style.display = 'none';
        }
    }
    if (inputValue === '') {
        ul.style.display = 'none';
    } else {
        ul.style.display = 'block';
    }
});

// Add click event listener to list items
for (var i = 0; i < listItems.length; i++) {
    listItems[i].addEventListener('click', function() {
        var selectedName = this.innerText;
        input.value = selectedName;
        ul.style.display = 'none';
    });
}
});

//
// Visitor Select
document.addEventListener('DOMContentLoaded', function() {
var visitorInput = document.getElementById('visitor-select');
var visitorList = document.getElementById('visitor-list');
var visitorListItems = visitorList.getElementsByTagName('li');

visitorInput.addEventListener('input', function() {
    var inputValue = this.value.toLowerCase();
    for (var i = 0; i < visitorListItems.length; i++) {
        var text = visitorListItems[i].innerText.toLowerCase();
        if (text.indexOf(inputValue) !== -1) {
            visitorListItems[i].style.display = 'block';
        } else {
            visitorListItems[i].style.display = 'none';
        }
    }
    if (inputValue === '') {
        visitorList.style.display = 'none';
    } else {
        visitorList.style.display = 'block';
    }
});

// Add click event listener to visitor list items
for (var i = 0; i < visitorListItems.length; i++) {
    visitorListItems[i].addEventListener('click', function() {
        var selectedName = this.innerText;
        visitorInput.value = selectedName;
        visitorList.style.display = 'none';
    });
}
});

