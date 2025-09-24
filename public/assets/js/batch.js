const dropArea = document.querySelector(".drag-image"),
      dragText = dropArea.querySelector("h6"),
      button = dropArea.querySelector("button"),
      input = dropArea.querySelector("input");

let files = []; 

button.onclick = () => {
  input.click(); 
};

input.addEventListener("change", function () {
  files = [...this.files];
  handleFiles(files);
});

dropArea.addEventListener("dragover", (event) => {
  event.preventDefault();
  dropArea.classList.add("active");
  dragText.textContent = "Release to Upload Files";
});

dropArea.addEventListener("dragleave", () => {
  dropArea.classList.remove("active");
  dragText.textContent = "Drag & Drop to Upload Files";
});

dropArea.addEventListener("drop", (event) => {
  event.preventDefault(); 
  files = [...event.dataTransfer.files];
  handleFiles(files);
});

function handleFiles(fileList) {
  dropArea.classList.add("active");
  dropArea.innerHTML = ""; // clear preview
  let validExtensions = ["application/pdf"];
  let maxSize = 5 * 1024 * 1024; // 5 MB
  let count = 0;

  for (let file of fileList) {
    if (count >= 999) break; // max 999 files
    if (!validExtensions.includes(file.type)) {
      alert(`${file.name} is not a PDF file!`);
      continue;
    }
    if (file.size > maxSize) {
      alert(`${file.name} exceeds 5 MB!`);
      continue;
    }

    // simple preview: show file name
    let div = document.createElement("div");
    div.textContent = `✔ ${file.name} (${(file.size/1024/1024).toFixed(2)} MB)`;
    dropArea.appendChild(div);
    count++;
  }

  if (count === 0) {
    dragText.textContent = "Drag & Drop to Upload Files";
    dropArea.classList.remove("active");
  }
}
