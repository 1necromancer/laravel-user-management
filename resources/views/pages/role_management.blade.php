<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .style-input {
            padding:4px;
            width: 100%;
            height: 100%;
            outline-style: none;
        }

        .new-input-data {
            background-color: red;
        }

        .editing-cell {
            background-color: #ffcece;
        }

        .remove-row-button {
            cursor: pointer;
            font-size: 14px;
            padding-top: 10px;
        }

        .styled-td {
            border: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>
    <nav class="bg-gray-800">
      <div class="sm:px-6">
        <div class="relative flex h-16 items-center justify-between">
          <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
            <div class="hidden sm:ml-6 sm:block">
              <div class="flex space-x-4">
                  <a href="/user_management" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Users</a>
                  <div class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Roles</div>
              </div>
            </div>
          </div>
          <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">


            <div class="relative ml-3">
            <button type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#fff"><path d="M24 13.616v-3.232c-1.651-.587-2.694-.752-3.219-2.019v-.001c-.527-1.271.1-2.134.847-3.707l-2.285-2.285c-1.561.742-2.433 1.375-3.707.847h-.001c-1.269-.526-1.435-1.576-2.019-3.219h-3.232c-.582 1.635-.749 2.692-2.019 3.219h-.001c-1.271.528-2.132-.098-3.707-.847l-2.285 2.285c.745 1.568 1.375 2.434.847 3.707-.527 1.271-1.584 1.438-3.219 2.02v3.232c1.632.58 2.692.749 3.219 2.019.53 1.282-.114 2.166-.847 3.707l2.285 2.286c1.562-.743 2.434-1.375 3.707-.847h.001c1.27.526 1.436 1.579 2.019 3.219h3.232c.582-1.636.75-2.69 2.027-3.222h.001c1.262-.524 2.12.101 3.698.851l2.285-2.286c-.744-1.563-1.375-2.433-.848-3.706.527-1.271 1.588-1.44 3.221-2.021zm-12 2.384c-2.209 0-4-1.791-4-4s1.791-4 4-4 4 1.791 4 4-1.791 4-4 4z"/></svg>
            </button>

              <div id="settingsDropdown" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                <a href="/" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <button id="addNewRole" class="border-1 rounded-md py-2 px-8 m-4 bg-blue-300 text-black hover:bg-blue-700 hover:text-white">
      Add
    </button>

    <button id="saveNewRole" class="border-1 rounded-md py-2 px-8 my-2 bg-green-300 text-black hover:bg-green-700 hover:text-white">
      Save
    </button>

    <button id="deleteRoles" class="border-1 rounded-md py-2 px-8 my-2 ml-4 bg-red-300 text-black hover:bg-red-700 hover:text-white">
      Delete
    </button>

    <table id="rolesTable" class="ml-4">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="border w-60 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Role
                </th>
            </tr>
        </thead>
        <tbody id="rolesTableBody" class="bg-white">
            @foreach ($roles as $role)
            <tr data-role-id="{{ $role->id }}">
                <td class="p-1 border">
                    {{ $role->name }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var settingsDropdown = document.getElementById('settingsDropdown');
        var userMenuButton = document.getElementById('user-menu-button');
        const table = document.getElementById('rolesTable');
        const tableBody = document.getElementById('rolesTableBody');
        const tableRows = document.querySelectorAll('tbody tr');

        tableBody.addEventListener('click', function(event) {
            var target = event.target;
            var editingRow = target.closest('tr');
            var editingValueId = editingRow.getAttribute('data-role-id');

            if (target.tagName.toLowerCase() === 'td') {
                var currentContent = target.innerHTML.trim();

                var input = document.createElement('input');
                input.type = 'text';
                input.value = currentContent;
                input.classList.add('style-input', 'editing-cell');

                target.innerHTML = '';
                target.appendChild(input);

                input.focus();

                input.addEventListener('blur', function() {
                    editedRoleFunction(input.value, editingValueId);
                    target.innerHTML = input.value;
                });
            }
        });

        userMenuButton.addEventListener('click', function() {
          settingsDropdown.classList.toggle('hidden');
        });

        const addNewRole = document.getElementById('addNewRole');
        addNewRole.addEventListener('click', addNewRoleFunction);

        const saveNewRole = document.getElementById('saveNewRole');
        saveNewRole.addEventListener('click', saveNewRoleFunction);

        const deleteRoles = document.getElementById('deleteRoles');
        deleteRoles.addEventListener('click', deleteRolesFunction);

        function editedRoleFunction(editedRole, editedRowId) {
            var updated_role = {
                new_role_name: editedRole,
                row_id: editedRowId
            };
            console.log('updated_role', updated_role);
            fetch('/update_role_name', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(updated_role)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
            console.log('data', data);

            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        };

        function saveNewRoleFunction() {
            const newInputCells = document.querySelectorAll('.new-input-data input');
            const newRoles = Array.from(newInputCells).map(input => input.value);
            console.log('newRoles', newRoles);

            fetch('/save_new_roles', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ roles: newRoles })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.roles_data && data.roles_data.length > 0) {
                    data.roles_data.forEach(roleData => {
                        newInputCells.forEach(input => {
                            const td = input.parentNode;
                            td.classList.remove('new-input-data');
                            const removeButtons = document.querySelectorAll('.remove-row-button');
                            removeButtons.forEach(button => button.parentNode.removeChild(button));
                        });
                        const inputCell = Array.from(newInputCells).find(cell => cell.value === roleData.name);
                        if (inputCell) {
                            const tr = inputCell.closest('tr');
                            if (tr) {
                                tr.setAttribute('data-role-id', roleData.id);
                            }
                        }
                    });
                }
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        };

        function addNewRoleFunction() {
            var newRow = document.createElement('tr');
            var inputCell = document.createElement('td');
            inputCell.classList.add('styled-td', 'new-input-data');
            var input = document.createElement('input');
            input.type = "text";
            input.classList.add('style-input');
            inputCell.appendChild(input);
            newRow.appendChild(inputCell);

            const removeButton = createRemoveButton();
            newRow.appendChild(removeButton);

            tableBody.appendChild(newRow);
        };

        function createRemoveButton() {
            const removeButton = document.createElement('button');
            svgElement = removeRowIcon();
            removeButton.appendChild(svgElement);
            removeButton.classList.add('remove-row-button');

            removeButton.addEventListener('click', () => {
                const row = removeButton.closest('tr');
                if (row) {
                    row.remove();
                }
            });

            return removeButton;
        }

        function removeRowIcon() {
            var svgElement = document.createElementNS("http://www.w3.org/2000/svg", "svg");
            svgElement.setAttribute("fill", "#000000");
            svgElement.setAttribute("height", "12px");
            svgElement.setAttribute("width", "12px");
            svgElement.setAttribute("version", "1.1");
            svgElement.setAttribute("xmlns", "http://www.w3.org/2000/svg");
            svgElement.setAttribute("xmlns:xlink", "http://www.w3.org/1999/xlink");
            svgElement.setAttribute("viewBox", "0 0 490 490");
            svgElement.setAttribute("xml:space", "preserve");

            var crossElement = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
            crossElement.setAttribute("points", "456.851,0 245,212.564 33.149,0 0.708,32.337 212.669,245.004 0.708,457.678 33.149,490 245,277.443 456.851,490 489.292,457.678 277.331,245.004 489.292,32.337");

            svgElement.appendChild(crossElement);
            return svgElement;
        }

        var isDeleteProcess = false;
        function addCheckboxColumn() {
            isDeleteProcess = true;

            const rows = table.querySelectorAll('tbody tr');
            const header = table.querySelector('thead tr');

            const th = document.createElement('th');
            th.textContent = 'Select';
            th.classList.add('border', 'w-20','uppercase', 'p-3', 'text-left', 'text-xs', 'font-medium', 'text-gray-500');

            header.prepend(th);

            rows.forEach((row) => {
                const td = document.createElement('td');
                td.style.alignItems = 'center';
                td.style.textAlign = 'center';
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.style.margin = '10px';
                checkbox.style.width = '15px';
                checkbox.style.height = '15px';
                checkbox.style.cursor = 'pointer';
                checkbox.style.textAlign = 'center';
                td.appendChild(checkbox);
                row.prepend(td);
            });
        }

        function deleteRolesFunction() {
            if (!isDeleteProcess) {
                var textNode = Array.from(deleteRoles.childNodes).find(
                    (node) =>
                        node.nodeType === Node.TEXT_NODE &&
                        node.textContent.trim() === 'Delete'
                );
                if (textNode) {
                    textNode.textContent = 'Delete selected';
                }
                addCheckboxColumn();
            } else {
                isDeleteProcess = false;
                var textNode = Array.from(deleteRoles.childNodes).find(
                    (node) =>
                        node.nodeType === Node.TEXT_NODE &&
                        node.textContent.trim() === 'Delete selected'
                );
                if (textNode) {
                    textNode.textContent = 'Delete';
                }
                deleteSelectedRoles();
            }
        }

        function deleteSelectedRoles() {
            const selectedRoles = [];
            const checkboxes = document.querySelectorAll('#rolesTable tbody input[type="checkbox"]:checked');
            checkboxes.forEach(checkbox => {
                var row = checkbox.closest('tr');
                var valueId = row.getAttribute('data-role-id');
                if (valueId) {
                    selectedRoles.push(Number(valueId));
                    row.remove();
                }
            });

            fetch('/delete_selected_roles', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ roles: selectedRoles })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
            removeSelectColumn();
        }

        function removeSelectColumn() {
            var headerRow = document.querySelector(
                '#rolesTable thead tr'
            );
            if (headerRow && headerRow.firstChild) {
                headerRow.removeChild(headerRow.firstChild);
            }

            var bodyRows = document.querySelectorAll(
                '#rolesTable tbody tr'
            );
            bodyRows.forEach(function (row) {
                if (row.firstChild) {
                    row.removeChild(row.firstChild);
                }
            });
        }

    });
</script>
