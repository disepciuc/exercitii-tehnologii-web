document.getElementById("country").addEventListener("change", function() {
    var country = this.value;
    fetchMesh(country);
});

function fetchMesh(country) {
    fetch("mash.php?country=" + country)
    .then(response => response.json())
    .then(data => {

         // Create image element
         var img = document.createElement('img');
         img.src = data.dogImage; // Specify image source

         // Create paragraph element
         var p = document.createElement('p');
         p.textContent = data.catFact; // Specify text content

         // Get reference to the div where you want to append
         var contentDiv = document.getElementById("mash-widget");

         // Append image and paragraph to the div
         contentDiv.appendChild(img);
         contentDiv.appendChild(p);
    })
    .catch(error => console.error("Error fetching weather:", error));
}
