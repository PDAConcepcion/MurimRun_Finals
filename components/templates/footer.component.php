<?php
function footer(array $customJs = []): void
{ ?>
    </main>
    <footer>
        <div class="footer-container">
            <div class="group-name">
                <img src="/assets/img/murimrun-wordmark-white.png" alt="">
            </div>

            <?php if (!empty($customJs)) {
                foreach ($customJs as $jsFile) {
                    echo "<script src=\"{$jsFile}\"></script>\n";
                }
            } ?>

            <div class="members-container">
                <p>Rey Vincent Putian</p>
                <p>Patrick Concepcion</p>
                <p>William Andres</p>
                <p>Gabriel Camino</p>
            </div>

            <div class="copyright">
                <p>© 2025 MurimRun, All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <script src="/assets/js/header.js"></script>

    </body>

    </html>
<?php } ?>