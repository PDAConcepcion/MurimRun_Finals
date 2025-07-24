<?php
function footer(array $customJs = []): void
{ ?>

    </main>
    <footer>
        <div class="footer-container">
            <div class="group-name">
                <a href="/index.php"><img src="/assets/img/murimrun-wordmark-white.png" alt="MurimRun Logo"></a>
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

            <p class="copyright">© 2025 MurimRun, All Rights Reserved.</p>
        </div>
    </footer>
    </body>

    </html>
<?php } ?>