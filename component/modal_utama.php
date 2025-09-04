<!-- Modal 1 -->
<div class="modal fade" id="modalUtama" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal1Label">Modal 1</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <button class="btn btn-info" id="btnMenuIGD">IGD</button>
        <button class="btn btn-info" id="btnMenuRJ">Rawat Jalan</button>
        <button class="btn btn-info" id="btnMenuRI">Rawat Inap</button>
        <button class="btn btn-info" id="btnMenuPemantauan">Penilaian / Pemantauan</button>
        <button class="btn btn-info" id="btnMenuIBS">RM IBS</button>

        <div class="section-igd" id="section-igd">
          <?php include __DIR__ . '/section/igd.php'; ?>
        </div>
        <div class="section-RJ" id="section-RJ">
          <?php include __DIR__ . '/section/rajal.php'; ?>
        </div>
        <div class="section-RI" id="section-RI">
          <?php include __DIR__ . '/section/ranap.php'; ?>
        </div>
        <div class="section-pemantauan" id="section-pemantauan">
          section Pemantauan
        </div>
        <div class="section-ibs" id="section-ibs">
          section IBS
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    // Default: cuma IGD yang tampil
    $("#section-RJ, #section-RI, #section-pemantauan, #section-ibs").hide();
    $("#section-igd").show();

    // Fungsi reset sederhana
    function resetSection(id) {
      $("#" + id).find("input, textarea, select").val("");
    }

    // Tombol IGD
    $("#btnMenuIGD").on("click", function() {
      $("#section-igd").show();
      $("#section-RJ, #section-RI, #section-pemantauan, #section-ibs").hide();

      resetSection("section-RJ");
      resetSection("section-RI");
      resetSection("section-pemantauan");
      resetSection("section-ibs");
    });

    // Tombol Rawat Jalan
    $("#btnMenuRJ").on("click", function() {
      $("#section-RJ").show();
      $("#section-igd, #section-RI, #section-pemantauan, #section-ibs").hide();

      resetSection("section-igd");
      resetSection("section-RI");
      resetSection("section-pemantauan");
      resetSection("section-ibs");
    });

    // Tombol Rawat Inap
    $("#btnMenuRI").on("click", function() {
      $("#section-RI").show();
      $("#section-igd, #section-RJ, #section-pemantauan, #section-ibs").hide();

      resetSection("section-igd");
      resetSection("section-RJ");
      resetSection("section-pemantauan");
      resetSection("section-ibs");
    });

    // Tombol Pemantauan
    $("#btnMenuPemantauan").on("click", function() {
      $("#section-pemantauan").show();
      $("#section-igd, #section-RJ, #section-RI, #section-ibs").hide();

      resetSection("section-igd");
      resetSection("section-RJ");
      resetSection("section-RI");
      resetSection("section-ibs");
    });

    // Tombol IBS
    $("#btnMenuIBS").on("click", function() {
      $("#section-ibs").show();
      $("#section-igd, #section-RJ, #section-RI, #section-pemantauan").hide();

      resetSection("section-igd");
      resetSection("section-RJ");
      resetSection("section-RI");
      resetSection("section-pemantauan");
    });

    // Reset ke default IGD saat modal ditutup
    $('#modalUtama').on('hidden.bs.modal', function() {
      $("#section-igd").show();
      $("#section-RJ, #section-RI, #section-pemantauan, #section-ibs").hide();

      resetSection("section-RJ");
      resetSection("section-RI");
      resetSection("section-pemantauan");
      resetSection("section-ibs");
    });
  });
</script>
