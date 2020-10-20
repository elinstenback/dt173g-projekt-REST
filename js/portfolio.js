// Projekt — DT0173G, Webbutveckling, Mittuniversitetet. Av Elin Stenbäck 2020 

"use strict";

// Variables
let portfolioEl = document.getElementById("printPortfolio");
let addPortfolioBtn = document.getElementById("addPortfolio");
let titleInput = document.getElementById("title");
let urlInput = document.getElementById("url");
let descriptionInput = document.getElementById("description");
let portfolioForm = document.getElementById("portfolioForm");
let portfolioIdInput = document.getElementById("portfolioId");

// Eventlisteners
window.addEventListener("load", getPortfolio);
portfolioForm.addEventListener("submit", (e) => {
    e.preventDefault();

    if (portfolioIdInput.value) {
        var id = portfolioIdInput.value;
        updatePortfolio(id);
    } else {
        addPortfolio();
    }
});

// Function to get portfolio table
function getPortfolio() {
    portfolioEl.innerHTML = "";
    fetch("http://elinstenback.se/projekt/portfolio.php")
        .then(response => response.json())
        .then(data => {
            data.forEach(portfolio => {
                portfolioEl.innerHTML +=
                    `<div class="portfolio">
                    <p>${portfolio.title}</p>
                    <a target="_blank" href="${portfolio.url}">Till sidan</a>
                    <p>${portfolio.description}</p>
                    <button id="${portfolio.id}" class="delete" onClick="deletePortfolio(${portfolio.id})">Radera</button>
                    <button id="${portfolio.id}" class="update" onClick="getElement(${portfolio.id})">Uppdatera</button>
                </div>`
            })
        })
}

// Function to add new content to table
function addPortfolio() {
    let title = titleInput.value;
    let url = urlInput.value;
    let description = descriptionInput.value;

    let portfolio = { "title": title, "url": url, "description": description };

    fetch("http://elinstenback.se/projekt/portfolio.php", {
        method: "POST",
        body: JSON.stringify(portfolio),
    })

    .then(response => response.json())
        .then(data => {
            getPortfolio(); // Update content
            titleInput.value = ""; // Empty inputs
            urlInput.value = "";
            descriptionInput.value = "";
        })
        .catch(error => {
            console.log("Error: ", error);
        })

}

// Function to delete in portfolio table
function deletePortfolio(id) {
    fetch("http://elinstenback.se/projekt/portfolio.php?id=" + id, {
            method: "DELETE",
        })
        .then(response => response.json())
        .then(data => {
            getPortfolio(); // Update content
        })
        .catch(error => {
            console.log("Error: ", error);
        })
}

// Get element input values for update
function getElement(id) {

    addPortfolioBtn.style.backgroundColor = '#ffbe00'; // Change color of button on update
    addPortfolioBtn.value = "Uppdatera"; // Change content in button on update

    fetch("http://elinstenback.se/projekt/portfolio.php?id=" + id)
        .then((response) => response.json())
        .then((data) => {
            data.forEach((portfolio) => {
                portfolioIdInput.value = `${portfolio.id}`;
                titleInput.value = `${portfolio.title}`;
                urlInput.value = `${portfolio.url}`;
                descriptionInput.value = `${portfolio.description}`;
            });
        });
}

// Update portfolio with changed input values
function updatePortfolio(id) {
    let index = portfolioIdInput.value;
    let title = titleInput.value;
    let url = urlInput.value;
    let description = descriptionInput.value;

    let portfolio = { "id": index, "title": title, "url": url, "description": description };


    addPortfolioBtn.style.backgroundColor = '#57a6aa'; // Change color of button when update is complete
    addPortfolioBtn.value = "Lägg till portfolio"; // Change content in button when update is complete

    fetch("http://elinstenback.se/projekt/portfolio.php?id=" + id, {
            method: "PUT",
            body: JSON.stringify(portfolio),
        })
        .then((response) => response.json())
        .then(data => {
            getPortfolio(); // Update content
            titleInput.value = ""; // Empty inputs
            urlInput.value = "";
            descriptionInput.value = "";
        })
        .catch((error) => {
            console.log("error: ", error);
        });
}