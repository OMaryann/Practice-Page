//to get current date on the footer
const yearspan = document.getElementById("currentyear");
const currentyear = new Date() .getFullYear();
yearspan.textContent = currentyear;

// To get last modified
document.getElementById("lastmodified").textContent = ` ${document.lastModified } `;

