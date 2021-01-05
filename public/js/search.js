
const itemname = document.querySelector('input[name="name"]');
const ilvmin = document.querySelector('input[name="ilvmin"]');
const ilvmax = document.querySelector('input[name="ilvmax"]');
const reqlvmin = document.querySelector('input[name="reqlvmin"]');
const reqlvmax = document.querySelector('input[name="reqlvmax"]');
const slot = document.querySelector('select[name="slot[]"]');
const rarity = document.querySelector('select[name="rarity[]"]');

const form = document.querySelector('.search-form');
const itemContainer = document.querySelector('#search-result-container table');
const commentContainer = document.querySelector('#comments-container table');

//console.log(itemContainer);

form.addEventListener("submit", function (event) {
    event.preventDefault();
    
    const data = {
        name : itemname.value,
        ilvmin : ilvmin.value,
        ilvmax : ilvmax.value,
        reqlvmin : reqlvmin.value,
        reqlvmax : reqlvmax.value,
        slot : getSelectValues(slot),
        rarity : getSelectValues(rarity)
    };

    fetch("/itemSearch", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (items) {
        itemContainer.innerHTML = "<tr><th>Name</th><th>Item Level</th> <th>Required Level</th> <th>Slot</th><th>Type</th></tr>";
        loadItems(items);
    });
    
    show("#search-result-container");
    hide("#comments-container");

    /*.then(response => response.text())
    .then((response) => {
        document.querySelector("body").innerHTML = response;
    })
    .catch(err => console.log(err));*/
    
});

function loadItems(items) {
    //console.log(items);
    items.forEach(item => {
        createItem(item);
    });
}

function createItem(item) {

    const template = document.querySelector("#item-template");

    const clone = template.content.cloneNode(true);

    const text = clone.querySelector("span");
    text.classList.add('q' + item.quality);
    text.innerHTML = item.name;
    
    clone.querySelector("#ilv").innerHTML = item.item_level;
    clone.querySelector("#rlv").innerHTML = item.required_level;
    clone.querySelector("#slot").innerHTML = item.slot;
    clone.querySelector("#type").innerHTML = item.equip_type;

    const ref = clone.querySelector(".itemref");
    ref.addEventListener("click", itemHref);
    ref.href = item.items_id;

    const refNew = clone.querySelector(".itemref-new");
    refNew.addEventListener("click", itemDetails);
    refNew.href = item.items_id;

    itemContainer.appendChild(clone);
}

function itemHref(event) {
    event.preventDefault();
    
    event = event || window.event;
    var target = event.target || event.srcElement;

    var itemid = null;
    while (target) {
        if (target instanceof HTMLAnchorElement) {
            itemid = target.getAttribute('href');
            break;
        }

        target = target.parentNode;
    }

    const data = {
        id : itemid
    };

    fetch("/itemRender", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(response => response.text())
    .then((response) => {
        document.querySelector(".itemtooltip").innerHTML = response.slice(0, -1);
    })
    .catch(err => console.log(err));
    return itemid;
}

function getSelectValues(select) {
    var result = [];
    var options = select && select.options;
    var opt;
  
    for (var i=0, iLen=options.length; i<iLen; i++) {
        opt = options[i];

        if (opt.selected) {
        result.push(opt.value || opt.text);
        }
    }
    return result;
}

function itemDetails(event) {
    var itemid = itemHref(event);

    show("#comments-container");
    hide("#search-result-container");

    loadItemsDetails(itemid);
}

function loadItemsDetails(itemid) {
    const data = {
        id : itemid
    };
    fetch("/itemComments", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then((response) => {
        commentContainer.innerHTML = '<tr><th>Score</th><th>Comments</th></tr>';
        loadComments(response);
        //document.querySelector(".itemtooltip").innerHTML = response.slice(0, -1);

    })
    .catch(err => console.log(err));
    
    //document.querySelector('#search-result-container').style.display = 'none';
}

function loadComments(comments) {
    console.log(comments);
    comments.forEach(comment => {
        console.log(comment );
        createComment(comment);
    });
}

function createComment(comment) {
    const template = document.querySelector("#comment-template");

    const clone = template.content.cloneNode(true);

    const score = clone.querySelector(".score");
    score.innerHTML = comment.score;
    
    clone.querySelector(".comment-header").innerHTML = 'By <a href="#"><span class="user">' + comment.author + '</span> <a> on ' + comment.date;
    clone.querySelector(".comment-text").innerHTML = comment.comment;

    if (comment.last_edit != null) {
        clone.querySelector(".comment-edit").innerHTML = 'Last edit:' + comment.edit;
    }

    console.log(commentContainer);
    commentContainer.appendChild(clone);
}

function show(name) {
    const container = document.querySelector(name);
    container.style.display = 'inline-block';
}

function hide(name) {
    const container = document.querySelector(name);
    container.style.display = 'none';
}
