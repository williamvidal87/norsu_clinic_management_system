
@push('medecine-inventory-scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        $(function() {
            $('#myTable').DataTable( {
            } );
        } );

        window.livewire.on('EmitTable', () => {
            if ($.fn.DataTable.isDataTable('#myTable'))  {
                $('#myTable').DataTable().destroy();
            }
                $('#myTable').DataTable( {
                } );
        });

        window.livewire.on('openmedecineinventoryModal', () => {
                $('#medecineinventoryModal').modal('show');
        });

        window.livewire.on('closemedecineinventoryModal', () => {
                $('#medecineinventoryModal').modal('hide');
        });

        window.livewire.on('deleteconfirm', ($data) => {
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
                window.Livewire.emit('DeleteData',$data)
            }
                window.Livewire.emit('refresh_request_checkup_table')
            })
        });

        // for success alert
        window.livewire.on('alert_store', () => {
                new PNotify({
                    title: 'Success',
                    type: 'success',
                    styling: 'bootstrap3',
                    delay: 3000
                });
        });

        // for update alert
        window.livewire.on('alert_update', () => {
                new PNotify({
                    title: 'Updated',
                    type: 'info',
                    styling: 'bootstrap3',
                    delay: 3000
                });
        });

        // for warning alert
        window.livewire.on('alert_warning', () => {
                new PNotify({
                    title: 'Warning',
                    type: 'notice',
                    styling: 'bootstrap3',
                    delay: 3000
                });
        });

        // for warning alert
        window.livewire.on('alert_delete', () => {
                new PNotify({
                    title: 'Deleted',
                    type: 'error',
                    styling: 'bootstrap3',
                    delay: 3000
                });
        });

    })
</script>
@endpush
