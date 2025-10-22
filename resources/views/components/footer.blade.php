<footer class="footer">
  <p>© 2025 Ecosend. All rights reserved.</p>
  <p>No. 10 Umbulharjo, Yogyakarta 55161 | +123-456-7890 | www.ecosend.com</p>
</footer>

<style>
  /* Layout dasar agar footer fleksibel */
  html, body {
    height: 50%;
    margin: 0;
    display: flex;
    flex-direction: column;
  }

  main {
    flex: 1; /* Isi halaman akan dorong footer ke bawah */
    padding-bottom: 20px;
  }


  /* Styling footer */
  .footer {
    background-color: #2f5130;
    color: white;
    text-align: center;
    padding: 15px 0;
    width: 100%;
  }

  .footer p {
    margin: 5px 0;
    font-size: 14px;
  }
</style>
