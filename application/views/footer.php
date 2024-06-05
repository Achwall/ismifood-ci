  </main>

  <footer class="page-footer grey lighten-3">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="grey-text text-darken-4">Alamat IsmiFood</h5>
          <p class="grey-text text-darken-3">Perumahan Kranggan Permai, Jl. Cempaka Raya BS6 No.27, RT 019/RW 012, Jatisampurna, Kota Bekasi 17433</p>
        </div>
        <div class="col l4 offset-l2 s12">
          <h5 class="grey-text text-darken-4">Informasi Kontak</h5>
          <ul>
            <li><a class="grey-text text-darken-3" href="https://www.facebook.com/ismiyati.riduwan" target="_blank">
              <img src="<?= site_url('./asset/images/facebook.svg'); ?>" style="width: 16px; margin: 0 2px -1px 0;"> Facebook
            </a></li>
            <li><a class="grey-text text-darken-3" href="https://www.instagram.com/ismiriduwan/" target="_blank">
              <img src="<?= site_url('./asset/images/square-instagram.svg'); ?>" class="sosmed"> Instagram
            </a></li>
            <li><a class="grey-text text-darken-3" href="https://wa.me/6281318488259" target="_blank">
              <img src="<?= site_url('./asset/images/square-whatsapp.svg'); ?>" class="sosmed"> 0813-1848-8259
            </a></li>
            <li><span class="grey-text text-darken-3">
              <img src="<?= site_url('./asset/images/square-envelope-solid.svg'); ?>" class="sosmed"> ismifood.kranggan@gmail.com
            </span></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container center-align">
        <p class="grey-text text-darken-2">&copy; 2024<?= ((date('Y') != '2024') ? ' - ' . date('Y') : ''); ?> IsmiFood. All Rights Reserved.</p>
      </div>
    </div>
  </footer>

  <script type="text/javascript">
    M.AutoInit();

    // Form Select
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('select');
      var instances = M.FormSelect.init(elems, options);
    });

    // Menampilkan file gambar yang dipilih pada form
    function thumbnail () {
      var preview = document.querySelector('#image');
      var file = document.querySelector('input[type=file]').files[0];
      var reader = new FileReader();

      reader.onloadend = function () {
        preview.src = reader.result;
      }

      if (file) {
        reader.readAsDataURL(file);
      } else {
        preview.src = "";
      }
    }

    // Dropdown Trigger
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.dropdown-trigger');
      var instances = M.Dropdown.init(elems, options);
    });

    // Fungsi Beli atau Checkout
    $('#beli').click(function (event) {
      if (!$("#cod").prop("checked")) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");

        var username = $("#username").val();
        var nama = $("#nama").val();
        var alamat = $("#alamat").val();
        var no_hp = $("#no_hp").val();
        var id_produk = $("#id_produk").val();
        var name = $("#name").val();
        var harga = $("#harga").val();
        var jumlah = $("#jumlah").val();
        var total = $("#total").val();

        $.ajax({
          type: 'POST',
          url: '<?=site_url('snap/token')?>',
          data: {
            username:username,
            nama:nama,
            alamat:alamat,
            no_hp:no_hp,
            id_produk:id_produk,
            name:name,
            harga:harga,
            jumlah:jumlah,
            total:total
          },
          cache: false,

          success: function(data) {
          //location = data;

            console.log('token = '+data);

            var resultType = document.getElementById('result-type');
            var resultData = document.getElementById('result-data');

            function changeResult(type,data){
              $("#result-type").val(type);
              $("#result-data").val(JSON.stringify(data));
            //resultType.innerHTML = type;
            //resultData.innerHTML = JSON.stringify(data);
            }

            snap.pay(data, {
              onSuccess: function(result){
                changeResult('success', result);
                console.log(result.status_message);
                console.log(result);
                $("#payment-form").submit();
              },
              onPending: function(result){
                changeResult('pending', result);
                console.log(result.status_message);
                $("#payment-form").submit();
              },
              onError: function(result){
                changeResult('error', result);
                console.log(result.status_message);
                $("#payment-form").submit();
              }
            });
          }
        });
      }
    });
  </script>

  <style media="screen">
    body {
      display: flex;
      min-height: 100vh;
      flex-direction: column;
      background-color: #f5f5f5;
      font-family: "Roboto", sans-serif;
    }

    main {
      flex: 1 0 auto;
    }

    footer {
      margin-top: 5vh;
      border-top: 4px solid #43a047;
    }

    h4, h5 {
      font-weight: bold;
    }

    hr.atau {
      border-top: 1px solid #aaa;
      overflow: visible;
      text-align: center;
      font-size: 14px;
      color: #aaa;
      margin: 4vh 0;
    }

    hr.atau::after {
      background: #fff;
      content: 'ATAU';
      padding: 0 20px;
      position: relative;
      top: -12px;
    }

    pre {
      font-family: roboto;
      margin-top: 4px;
      max-width: 80vh;
      white-space: pre-wrap;
      overflow-wrap: break-word;
    }

    .fixed-action-btn .btn-floating {
      background-color: #25d366;
      margin-right: -1vh;
    }

    .hide-on-med-and-down .btn-floating {
      width: 240px;
      height: 48px;
      border-radius: 24px;
      margin-bottom: 3vh;
      font-size: 16px;
    }

    .fixed-action-btn .wa-large {
      width: 28px;
      margin: 9px 2px -9px 0;
    }

    .fixed-action-btn .wa-small {
      width: 28px;
      margin-top: 12px;
    }

    span.new.badge {
      border-radius: 12px;
      min-width: 24px;
    }

    .container {
      min-width: 80%;
    }

    .card {
      border-radius: 2vh;
    }

    .beranda {
      background: url('asset/images/bg-home.jpg') no-repeat;
      background-position: center;
      background-size: cover;
      margin-top: 0;
    }

    .form-wrapper {
      background-color: #fff;
      border-radius: 1vh;
      margin-top: 3vh;
      padding-left: 4vh;
      padding-right: 4vh;
    }

    .btn-login {
      font-weight: 500;
      width: 100%;
    }

    .modal {
      width: 50vh;
    }

    .errorflash {
      padding-top: 1vh;
      padding-bottom: 1vh;
    }

    .sosmed {
      width: 16px;
      margin: 8px 2px -3px 0;
    }
  </style>
</body>
</html>