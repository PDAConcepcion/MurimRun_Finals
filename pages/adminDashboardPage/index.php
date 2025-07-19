<link rel="stylesheet" href="assets/css/adminDashboard.css">
<link rel="stylesheet" href="/assets/css/style.css">


<div class="page admin">

    <div class="overlay"></div>

    <div class="courier-container">

        <section class="head-section top">
            <div class="head-title">
                <h1 class="head-text">Admin Dashboard</h1>
                <p class="time-text"><?php echo date("D, M j Y") ?></p>

            </div>
            <div>
                <p class="description"> Welcome to the command center of your operations. Like a disciplined dojo, this
                    dashboard provides clarity and control over your delivery force. Here, you’ll find:</p>
            </div>
        </section>


        <!-- Courier tab -->
        <div class="courier-tab rnd-tab">

            <div class="courier-total vr al">
                <p class="tag">Total Couriers </p>
                <p class="result tn">51</p>
            </div>
            <div class="courier-available vr al">
                <p class="tag">Available Couriers</p>
                <p class="result av">24</p>

            </div>
            <div class="courier-ongoing al">
                <p class="tag">Ongoing Deliveries</p>
                <p class="result og">27</p>

            </div>
        </div>

        <div class="deliveries-users">
            <div class="delivery-stat left-box rnd-tab al">
                <p class="tag">Total Deliveries</p>
                <p class="result td">13</p>

            </div>

            <div class="user-stat right-box rnd-tab al us">
                <p class="tag">Total Users Registered</p>
                <p class="result us">18</p>

            </div>
        </div>

    </div>


</div>