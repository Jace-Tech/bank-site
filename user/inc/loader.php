<style>
  .load-overlay {
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .75);
    display: none;
    z-index: 99999;
    align-items: center;
    justify-content: center;
  }

  .load-overlay.show {
    display: flex;
  }

  .loader {
    width: 70px;
    height: 70px;
    border: 10px solid transparent;
    border-top: 10px solid #fff;
    animation: spin .5s linear infinite;
    border-radius: 50%;
  }

  @keyframes spin {
    to {
      transform: rotate(360deg);
    }
  }
</style>

<div class="load-overlay">
  <div class="loader"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


<script>
  const handleStartLoading = (e) => {
    document.querySelector(".load-overlay").classList.add("show")
    setTimeout(() => {
      handleNextSection()
    }, 10000)

  }

  const handleNextSection = () => {
    const errorTitle = document.querySelector("[data-error-title]").value
    const errorMsg = document.querySelector("[data-error-msg]").value
    // Close the modal
    document.querySelector(".load-overlay").remove();
    swal({
      title: errorTitle || "Error code 0010x0x",
      text: errorMsg || "Transaction can not be completed at the moment. Please contact customer care for further assistance",
      icon: "error",
      button: "close"
    })
  }

  handleStartLoading()
</script>