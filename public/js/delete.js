const table = document.getElementById('tableList');

if(table){
    table.addEventListener('click', e => {
        if(e.target.className === 'btn btn-danger btn-xs delete'){
            if(confirm('Czy na pewno usunąć rekord?')){
                const id = e.target.getAttribute('data-id');
                const type = e.target.getAttribute('data-type');

                fetch(`/${type}/delete/${id}`,{
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}