<style>
    @media print {
        @page {
            size: 100mm auto;
            margin: 0;
        }
        nav {
            display: none;
        }
        .btn-print {
            display: none;
        }

    }
</style>
<div>

    <div class="btn-print flex justify-center">
    <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Cetak Struk
    </button>
</div>
<pre>{!! $struk !!}</pre>
</div>
<script>
    window.onload = function() {
        window.print();
     };
</script>

