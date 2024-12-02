$(document).ready(function(){
    $('#addRow').click(function(){
        const newRow = `<tr>
        <td>No</td>
        <td>Nama Baru</td>
        <td>email@baru.com</td>
        <td>
            <button class="edit">Edit</button>
            <button class="delete">Hapus</button>
        </td>
    </tr>`;
    $('#alumniTable tbody').append(newRow);
    });

    $('#alumniTable').on('click','edit',function(){
        const row = $(this).closest('tr');
        const no = row.find('td').eq(0).text();
        const name = row.find('td').eq(1).text();
        const email = row.find('td').eq(2).text();

        const newNomor = prompt('Edit Nomor:', no);
        const newName = prompt('Edit Nama:', name);
        const newEmail = prompt('Edit Email:', email);

        if(newNomor!== null && newName !== null && newEmail !== null){
            row.find('td').eq(0).text();
            row.find('td').eq(1).text();
            row.find('td').eq(2).text();
        }
    });

    $('#alumniTable').on('click', '.delete', function(){
        if(confirm('Apakan Anda yakin ingin menghapus baris ini?')){
            $(this).closest('tr').remove();
        }
    });
    });
