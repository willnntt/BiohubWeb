<html lang="en">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body{
    background: #FFF
}

.logo{
    width:70%;
}

footer{
    width: 100%;
    position: relative;
    bottom: 0;
    background:#EBE3D2;
    color:#2f3d2b;
    padding:20px 0 20px;
    font-size: 13px;
    line-height: 20px;
    display:flex;
}

.row{
    width: 85%;
    margin: auto;
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    justify-content: space-between;
}

.col{
    flex-basis: 20%;
    padding:10px;
}

.col h3{
    width: fit-content;
    margin-bottom:10px;
    position: relative;

}

.email-id{
    width: fit-content;
    margin: 10px 0;
}

ul li{
    list-style:none;
    color:#000;
}

.social-icons i{
    font-size: 20px; 
    margin: 0 5px;
}
</style>
<footer class="footer">
        <div class="row"> 
            <div class="col">
                <img src="logo.png" class="logo">
                <p>BioHub is a one-stop platform offering eco-friendly products, community discussions, and sustainability-focused activities. Our goal is to provide informative resources, interactive features, and real-time collaboration opportunities for individuals and businesses committed to a greener future.</p>
            </div>
            <div class="col">
                <h3>Contact Us</h3>
                <p><b>BioHub.Sdn.Bhd.</b></p>
                <p>Jalan Teknologi 5, Taman Teknologi Malaysia, 57000 Kuala Lumpur...</p> 
                <p class="email-id">biohub@gmail.com</p>
                <h4>+6012 7894578</h4>
            </div>
            <div class="col">
                <h3>Links</h3>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="recycling_program.php">Recycling Program</a></li>
                    <li><a href="ECT.php">Energy Conservation Tips</a></li>
                    <li><a href="CG_file/community.php">Our Community</a></li>
                    <li><a href="productswap.php">Swap & Share</a></li>
                </ul>
            </div>
            <div class="col">
                <h3>Follow Us</h3>
                <div class="social-icons">
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-x-twitter"></i>
                    <i class="fa-brands fa-whatsapp"></i>
                    <i class="fa-brands fa-linkedin"></i>
                </div>
            </div>
        </div>
    </footer>    
</body>
</html>