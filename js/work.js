// Projekt — DT0173G, Webbutveckling, Mittuniversitetet. Av Elin Stenbäck 2020 

"use strict";

// Variables
let workEl = document.getElementById("printWork");
let addWorkBtn = document.getElementById("addWork");
let workNameInput = document.getElementById("workName");
let workTitleInput = document.getElementById("workTitle");
let workDateInput = document.getElementById("workDate");
let workForm = document.getElementById("workForm");
let workIdInput = document.getElementById("workId");

// Eventlisteners
window.addEventListener("load", getWork);
workForm.addEventListener("submit", (e) => {
    e.preventDefault();

    if (workIdInput.value) {
        var id = workIdInput.value;
        updateWork(id);
    } else {
        addWork();
    }
});

// Function to get work table
function getWork() {
    workEl.innerHTML = "";
    fetch("http://elinstenback.se/projekt/work.php")
        .then(response => response.json())
        .then(data => {
            data.forEach(work => {
                workEl.innerHTML +=
                    `<div class="work">
                    <p>${work.name}</p>
                    <p>${work.title}</p>
                    <p>${work.date}</p>
                    <button id="${work.id}" class="delete" onClick="deleteWork(${work.id})">Radera</button>
                    <button id="${work.id}" class="update" onClick="getElementWork(${work.id})">Uppdatera</button>
                </div>`
            })
        })
}

// Function to add new content to work table
function addWork() {
    let workName = workNameInput.value;
    let workTitle = workTitleInput.value;
    let workDate = workDateInput.value;

    let work = { "name": workName, "title": workTitle, "date": workDate };

    fetch("http://elinstenback.se/projekt/work.php", {
        method: "POST",
        body: JSON.stringify(work),

    })

    .then(response => response.json())
        .then(data => {
            getWork(); // Update content
            workNameInput.value = ""; // Empty inputs
            workTitleInput.value = "";
            workDateInput.value = "";
        })
        .catch(error => {
            console.log("Error: ", error);
        })

}

// Function to delete in work table
function deleteWork(id) {
    fetch("http://elinstenback.se/projekt/work.php?id=" + id, {
            method: "DELETE",
        })
        .then(response => response.json())
        .then(data => {
            getWork(); // Update content
        })
        .catch(error => {
            console.log("Error: ", error);
        })
}

// Get work element input values for update
function getElementWork(id) {

    addWorkBtn.style.backgroundColor = '#ffbe00'; // Change color on button on update
    addWorkBtn.value = "Uppdatera"; // Change content in button on update

    fetch("http://elinstenback.se/projekt/work.php?id=" + id)
        .then((response) => response.json())
        .then((data) => {
            data.forEach((work) => {
                workIdInput.value = `${work.id}`;
                workNameInput.value = `${work.name}`;
                workTitleInput.value = `${work.title}`;
                workDateInput.value = `${work.date}`;
            });
        });
}

// Update portfolio with changed input values
function updateWork(id) {
    let index = workIdInput.value;
    let workName = workNameInput.value;
    let workTitle = workTitleInput.value;
    let workDate = workDateInput.value;

    let work = { "id": index, "name": workName, "title": workTitle, "date": workDate };

    addWorkBtn.style.backgroundColor = '#57a6aa'; // Change color on button after update
    addWorkBtn.value = "Lägg till arbete"; // Change content in button after update

    fetch("http://elinstenback.se/projekt/work.php?id=" + id, {
            method: "PUT",
            body: JSON.stringify(work),
        })
        .then((response) => response.json())
        .then(data => {
            getWork(); // Update content
            workNameInput.value = ""; // Empty input
            workTitleInput.value = "";
            workDateInput.value = "";
        })
        .catch((error) => {
            console.log("error: ", error);
        });
}