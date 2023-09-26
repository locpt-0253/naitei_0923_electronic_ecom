document.addEventListener('DOMContentLoaded', () => {
    const imageInput = document.getElementById('images');
    const imageBody = document.getElementById('imageBody');
    let objectURLs = [];

    imageInput.addEventListener('change', () => {
        const files = imageInput.files;

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const objectURL = URL.createObjectURL(file);
            objectURLs.push(objectURL);

            const newRow = document.createElement('div');
            newRow.classList.add('row');

            const imageCell = document.createElement('div');
            imageCell.classList.add('cell');
            const imageElement = document.createElement('img');
            imageElement.classList.add('max-w-[100px]', 'max-h-[100px]');
            imageElement.src = objectURL;
            imageCell.appendChild(imageElement);
            newRow.appendChild(imageCell);

            const statusCell = document.createElement('div');
            statusCell.classList.add('cell');
            statusCell.textContent = 'new';
            newRow.appendChild(statusCell);

            const deleteCell = document.createElement('div');
            deleteCell.classList.add('cell');
            const deleteButton = document.createElement('button');
            deleteButton.innerHTML = '&times;';
            deleteButton.addEventListener('click', () => {
                const row = deleteButton.closest('.row');
                const imageCell = row.querySelector('.cell:first-child');
                const imageElement = imageCell.querySelector('img');
                const imageURL = imageElement.src;

                row.remove();
                URL.revokeObjectURL(imageURL);
                const index = objectURLs.indexOf(imageURL);
                if (index > -1) {
                    objectURLs.splice(index, 1);
                }
                removeFileFromFileList(index, imageInput)
            });
            deleteCell.appendChild(deleteButton);
            newRow.appendChild(deleteCell);

            imageBody.appendChild(newRow)
        }
    });

    function removeFileFromFileList(index, input) {
        const dt = new DataTransfer();
        const {
            files
        } = input;

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (index !== i)
                dt.items.add(file);
        }

        input.files = dt.files;
    }

    window.addEventListener('beforeunload', () => {
        objectURLs.forEach(URL.revokeObjectURL);
    });
});
