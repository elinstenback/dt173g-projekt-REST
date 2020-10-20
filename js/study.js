// Projekt — DT0173G, Webbutveckling, Mittuniversitetet. Av Elin Stenbäck 2020 

"use strict";

// Variables
let studyEl = document.getElementById("printStudy");
let addStudyBtn = document.getElementById("addStudy");
let universityInput = document.getElementById("university");
let courseNameInput = document.getElementById("courseName");
let dateInput = document.getElementById("date");
let studyForm = document.getElementById("studyForm");
let studyIdInput = document.getElementById("studyId");

// Eventlisteners
window.addEventListener("load", getStudy);
studyForm.addEventListener("submit", (e) => {
    e.preventDefault();

    if (studyIdInput.value) {
        var id = studyIdInput.value;
        updateStudy(id);
    } else {
        addStudy();
    }
});

// Function to get study table
function getStudy() {
    studyEl.innerHTML = "";
    fetch("http://elinstenback.se/projekt/study.php")
        .then(response => response.json())
        .then(data => {
            data.forEach(study => {
                studyEl.innerHTML +=
                    `<div class="study">
                    <p>${study.university}</p>
                    <p>${study.coursename}</p>
                    <p>${study.date}</p>
                    <button id="${study.id}" class="delete" onClick="deleteStudy(${study.id})">Radera</button>
                    <button id="${study.id}" class="update" onClick="getElementStudy(${study.id})">Uppdatera</button>
                </div>`
            })
        })
}

// Function to add new content to study table
function addStudy() {
    let university = universityInput.value;
    let courseName = courseNameInput.value;
    let date = dateInput.value;

    let study = { "university": university, "coursename": courseName, "date": date };

    fetch("http://elinstenback.se/projekt/study.php", {
        method: "POST",
        body: JSON.stringify(study),
    })

    .then(response => response.json())
        .then(data => {
            getStudy(); // Update content
            universityInput.value = ""; // Empty inputs
            courseNameInput.value = "";
            dateInput.value = "";
        })
        .catch(error => {
            console.log("Error: ", error);
        })

}

// Function to delete in study table
function deleteStudy(id) {
    fetch("http://elinstenback.se/projekt/study.php?id=" + id, {
            method: "DELETE",
        })
        .then(response => response.json())
        .then(data => {
            getStudy(); // Update content
        })
        .catch(error => {
            console.log("Error: ", error);
        })
}

// Get study element input values for update
function getElementStudy(id) {

    addStudyBtn.style.backgroundColor = '#ffbe00'; // Change color for button on update
    addStudyBtn.value = "Uppdatera"; // Change content in button on update

    fetch("http://elinstenback.se/projekt/study.php?id=" + id)
        .then((response) => response.json())
        .then((data) => {
            data.forEach((study) => {
                studyIdInput.value = `${study.id}`;
                universityInput.value = `${study.university}`;
                courseNameInput.value = `${study.coursename}`;
                dateInput.value = `${study.date}`;
            });
        });
}

// Update study with changed input values
function updateStudy(id) {
    let index = studyIdInput.value;
    let university = universityInput.value;
    let coursename = courseNameInput.value;
    let date = dateInput.value;

    let study = { "id": index, "university": university, "coursename": coursename, "date": date };

    addStudyBtn.style.backgroundColor = '#57a6aa'; // Change color for button after update
    addStudyBtn.value = "Lägg till studie"; // Change content in button after update

    fetch("http://elinstenback.se/projekt/study.php?id=" + id, {
            method: "PUT",
            body: JSON.stringify(study),
        })
        .then((response) => response.json())
        .then(data => {
            getStudy(); // Update content
            universityInput.value = ""; // Empty inputs
            courseNameInput.value = "";
            dateInput.value = "";
        })
        .catch((error) => {
            console.log("error: ", error);
        });
}