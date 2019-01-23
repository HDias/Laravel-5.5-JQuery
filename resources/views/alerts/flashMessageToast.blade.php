@if (session('alert')['type'] == 'danger')
    <script>
        setTimeout(function () {
            Vue.toasted.show('{{ session('alert')['message']  }}', {
                icon: {
                    name: 'thumbs-down',
                    after: false
                },
                theme: "primary",
                position: "bottom-right",
                action: [
                    {
                        text: 'Recarregar',
                        onClick: (e, toastObject) => {
                            toastObject.goAway(0); // Fecha o Toast
                            window.location.href = '{{ url()->current() }}' // Recarrega a página
                        }
                    }
                ]
            });
        }, 500);
    </script>
@endif

@if (session('alert')['type'] == 'success')
    <script>
        setTimeout(function () {
            Vue.toasted.show('{{ session('alert')['message']  }}', {
                icon: {
                    name: 'thumbs-up',
                    after: false
                },
                className: "bg-success",
                duration: 3000,
                theme: "primary",
                position: "bottom-right"
            });
        }, 500);
    </script>
@endif


@if (!empty(session('csrf_error')))
    <script>
        setTimeout(function () {
            Vue.toasted.show('Sua Página Expirou! Recarregue a página e tente novamente.', {
                icon: {
                    name: 'thumbs-down',
                    after: false
                },
                theme: "primary",
                position: "bottom-right",
                action: [
                    {
                        text: 'Recarregar',
                        onClick: (e, toastObject) => {
                            toastObject.goAway(0); // Fecha o Toast
                            window.location.href = '{{ url()->current() }}';// Recarrega a página
                        }
                    }
                ]
            });
        }, 500);

    </script>
@endif
