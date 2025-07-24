<script>

    $(document).ready(function() {
        $('#search-btn').on('click', function(event) {
            event.preventDefault();

            let data = {
                search_item: $('#searchUser').val(),
                _token: $('meta[name="csrf-token"]').attr('content') // Add CSRF token
            };

            axios.post("{{ route('users.search') }}", {
                search: $('#searchUser').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            }).then(response => {
                if (response.data.success) {
                    updateTable(response.data);
                }
            }).catch(error => {
                console.error(error.response.data);
            });
        });

        function updateTable(response) {
            const itemBody = $('#search-body');
            itemBody.empty();

            if (response.count > 0) {
                response.data.forEach(function(row) {
                    const htmlCode = `
                        <tr>
                            <td>${row.created_at}</td>
                            <td>${row.name}</td>
                            <td>${row.email}</td>
                            <td>${row.role.name}</td> 
                            <td>
                                <a href="${row.editLink}" class="btn btn-info">Edit</a>
                                <form method="POST" action="${row.toggleActivateLink}" style="display: inline-block;">
                                    <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="is_active" value="${row.is_active ? 0 : 1}">
                                    <button type="submit" class="btn btn-${row.is_active ? 'danger' : 'warning'} btn-sm m-1">
                                        ${row.is_active ? 'Deactivate' : 'Activate'}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    `;
                    itemBody.append(htmlCode);
                });
            } else {
                itemBody.html('<tr><td colspan="7">No Items found</td></tr>');
            }
        }
    });

</script>