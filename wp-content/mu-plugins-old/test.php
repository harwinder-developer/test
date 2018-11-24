<?php

// add_filter( 'pp_custom_campaign_fields', 'remov' );
// function remov($fields){

//     unset($fields['PP_Merchandise']);

//     return $fields;
// }   

// add_filter( 'edd_log_test_payment_stats', '__return_true' );

add_action( 'admin_init', 'debug_admin' );
function debug_admin(){
    if(!isset($_GET['debug_admin']))
        return;

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

function add_donation_from_api($donation_args, $payment_id, $args){

	echo "<pre>";
	print_r($donation_args);
	echo "</pre>";
	exit();

	return $donation_args;
}

add_action( 'template_redirect', 'debug', 1 );	
function debug(){
	if(!isset($_GET['debug']))
		return;

    $p = get_post_meta( 35725, 'salesforce_event_id', true );
    var_dump( is_wp_error( $p ) );
    exit();


    set_time_limit(0);

    $data = [
                ["KS-Omicron-Epsilon","1kappasigma@greeks4good.com","KS1!","001i000000yoDhI","Omicron-Epsilon","Kappa Sigma","Campaign Creator","Adelphi University","Kappa Sigma","Omicron-Epsilon","Kappa Sigma - Omicron-Epsilon"  ],
                ["KS-Tau-Sigma","2kappasigma@greeks4good.com","KS1!","001i000000yoDdT","Tau-Sigma","Kappa Sigma","Campaign Creator","Angelo State University","Kappa Sigma","Tau-Sigma","Kappa Sigma - Tau-Sigma"  ],
                ["KS-Lambda-Nu","3kappasigma@greeks4good.com","KS1!","001i000000yoDhm","Lambda-Nu","Kappa Sigma","Campaign Creator","Appalachian State University","Kappa Sigma","Lambda-Nu","Kappa Sigma - Lambda-Nu"  ],
                ["KS-Omicron-Gamma","4kappasigma@greeks4good.com","KS1!","001i000000yoDjx","Omicron-Gamma","Kappa Sigma","Campaign Creator","Arkansas Tech University","Kappa Sigma","Omicron-Gamma","Kappa Sigma - Omicron-Gamma"  ],
                ["KS-Omicron-Iota","5kappasigma@greeks4good.com","KS1!","001i000000yoDhT","Omicron-Iota","Kappa Sigma","Campaign Creator","Armstrong State University","Kappa Sigma","Omicron-Iota","Kappa Sigma - Omicron-Iota"  ],
                ["KS-Theta-Nu","6kappasigma@greeks4good.com","KS1!","001i000000yoDg7","Theta-Nu","Kappa Sigma","Campaign Creator","Ashland University","Kappa Sigma","Theta-Nu","Kappa Sigma - Theta-Nu"  ],
                ["KS-Beta-Eta","7kappasigma@greeks4good.com","KS1!","001i000000yoDkj","Beta-Eta","Kappa Sigma","Campaign Creator","Auburn University","Kappa Sigma","Beta-Eta","Kappa Sigma - Beta-Eta"  ],
                ["KS-Mu-Tau Colony","8kappasigma@greeks4good.com","KS1!","001i000000yoDiX","Mu-Tau Colony","Kappa Sigma","Campaign Creator","Austin Peay State University","Kappa Sigma","Mu-Tau Colony","Kappa Sigma - Mu-Tau Colony"  ],
                ["KS-Beta-Tau","9kappasigma@greeks4good.com","KS1!","001i000000yoDjh","Beta-Tau","Kappa Sigma","Campaign Creator","Baker University","Kappa Sigma","Beta-Tau","Kappa Sigma - Beta-Tau"  ],
                ["KS-Lambda-Tau","10kappasigma@greeks4good.com","KS1!","001i000000yoDgP","Lambda-Tau","Kappa Sigma","Campaign Creator","Baylor University","Kappa Sigma","Lambda-Tau","Kappa Sigma - Lambda-Tau"  ],
                ["KS-Rho-Lambda","11kappasigma@greeks4good.com","KS1!","001i000000yoDjP","Rho-Lambda","Kappa Sigma","Campaign Creator","Belmont Abbey College","Kappa Sigma","Rho-Lambda","Kappa Sigma - Rho-Lambda"  ],
                ["KS-Pi-Kappa","12kappasigma@greeks4good.com","KS1!","001i000000yoDfF","Pi-Kappa","Kappa Sigma","Campaign Creator","Bentley University","Kappa Sigma","Pi-Kappa","Kappa Sigma - Pi-Kappa"  ],
                ["KS-Tau-Xi","13kappasigma@greeks4good.com","KS1!","001i000000yoDdv","Tau-Xi","Kappa Sigma","Campaign Creator","Bethel University","Kappa Sigma","Tau-Xi","Kappa Sigma - Tau-Xi"  ],
                ["KS-Omicron-Psi","14kappasigma@greeks4good.com","KS1!","001i000000yoDgZ","Omicron-Psi","Kappa Sigma","Campaign Creator","Bloomsburg University of Pennsylvania","Kappa Sigma","Omicron-Psi","Kappa Sigma - Omicron-Psi"  ],
                ["KS-Kappa-Rho","15kappasigma@greeks4good.com","KS1!","001i000000yoDfT","Kappa-Rho","Kappa Sigma","Campaign Creator","Boise State University","Kappa Sigma","Kappa-Rho","Kappa Sigma - Kappa-Rho"  ],
                ["KS-Mu-Psi","16kappasigma@greeks4good.com","KS1!","001i000000yoDh0","Mu-Psi","Kappa Sigma","Campaign Creator","Boston University","Kappa Sigma","Mu-Psi","Kappa Sigma - Mu-Psi"  ],
                ["KS-Cameron","17kappasigma@greeks4good.com","KS1!","001i000002DIhiV","Cameron University Colony","Kappa Sigma","Campaign Creator","Cameron University","Kappa Sigma","Cameron University Colony","Kappa Sigma - Cameron University Colony"  ],
                ["KS-Sigma-Phi","18kappasigma@greeks4good.com","KS1!","001i000000yoDe9","Sigma-Phi","Kappa Sigma","Campaign Creator","Campbell University","Kappa Sigma","Sigma-Phi","Kappa Sigma - Sigma-Phi"  ],
                ["KS-Tau-Mu","19kappasigma@greeks4good.com","KS1!","001i000000yoDdu","Tau-Mu","Kappa Sigma","Campaign Creator","Capital University","Kappa Sigma","Tau-Mu","Kappa Sigma - Tau-Mu"  ],
                ["KS-Cardinal-Stritch","20kappasigma@greeks4good.com","KS1!","001i00000191pf3","Cardinal Stritch University Colony","Kappa Sigma","Campaign Creator","Cardinal Stritch University","Kappa Sigma","Cardinal Stritch University Colony","Kappa Sigma - Cardinal Stritch University Colony"  ],
                ["KS-Delta-Alpha","21kappasigma@greeks4good.com","KS1!","001i000000yoDfw","Delta-Alpha","Kappa Sigma","Campaign Creator","Carnegie Mellon University","Kappa Sigma","Delta-Alpha","Kappa Sigma - Delta-Alpha"  ],
                ["KS-Sigma-Psi","22kappasigma@greeks4good.com","KS1!","001i000000yoDdi","Sigma-Psi","Kappa Sigma","Campaign Creator","Catholic University of America","Kappa Sigma","Sigma-Psi","Kappa Sigma - Sigma-Psi"  ],
                ["KS-Epsilon","23kappasigma@greeks4good.com","KS1!","001i000000yoDjM","Epsilon","Kappa Sigma","Campaign Creator","Centenary College of Louisiana","Kappa Sigma","Epsilon","Kappa Sigma - Epsilon"  ],
                ["KS-Sigma-Eta","24kappasigma@greeks4good.com","KS1!","001i000000yoDjJ","Sigma-Eta","Kappa Sigma","Campaign Creator","Central Michigan University","Kappa Sigma","Sigma-Eta","Kappa Sigma - Sigma-Eta"  ],
                ["KS-Rho-Mu","25kappasigma@greeks4good.com","KS1!","001i000000yoDea","Rho-Mu","Kappa Sigma","Campaign Creator","Central Washington University","Kappa Sigma","Rho-Mu","Kappa Sigma - Rho-Mu"  ],
                ["KS-Xi-Eta","26kappasigma@greeks4good.com","KS1!","001i000000yoDfs","Xi-Eta","Kappa Sigma","Campaign Creator","Christian Brothers University","Kappa Sigma","Xi-Eta","Kappa Sigma - Xi-Eta"  ],
                ["KS-Sigma-Lambda","27kappasigma@greeks4good.com","KS1!","001i000000yoDe1","Sigma-Lambda","Kappa Sigma","Campaign Creator","Christopher Newport University","Kappa Sigma","Sigma-Lambda","Kappa Sigma - Sigma-Lambda"  ],
                ["KS-Kappa-Upsilon","28kappasigma@greeks4good.com","KS1!","001i000000yoDho","Kappa-Upsilon","Kappa Sigma","Campaign Creator","Clemson University","Kappa Sigma","Kappa-Upsilon","Kappa Sigma - Kappa-Upsilon"  ],
                ["KS-Pi-Theta","29kappasigma@greeks4good.com","KS1!","001i000000yoDf7","Pi-Theta","Kappa Sigma","Campaign Creator","Coastal Carolina University","Kappa Sigma","Pi-Theta","Kappa Sigma - Pi-Theta"  ],
                ["KS-Nu","30kappasigma@greeks4good.com","KS1!","001i000000yoDhc","Nu","Kappa Sigma","Campaign Creator","College of William and Mary","Kappa Sigma","Nu","Kappa Sigma - Nu"  ],
                ["KS-Beta-Omega","31kappasigma@greeks4good.com","KS1!","001i000000yoDjz","Beta-Omega","Kappa Sigma","Campaign Creator","Colorado College","Kappa Sigma","Beta-Omega","Kappa Sigma - Beta-Omega"  ],
                ["KS-Sigma-Mu","32kappasigma@greeks4good.com","KS1!","001i000000yoDe2","Sigma-Mu","Kappa Sigma","Campaign Creator","Colorado Mesa University","Kappa Sigma","Sigma-Mu","Kappa Sigma - Sigma-Mu"  ],
                ["KS-Gamma-Gamma","33kappasigma@greeks4good.com","KS1!","001i000000yoDfW","Gamma-Gamma","Kappa Sigma","Campaign Creator","Colorado School of Mines","Kappa Sigma","Gamma-Gamma","Kappa Sigma - Gamma-Gamma"  ],
                ["KS-Xi-Iota","34kappasigma@greeks4good.com","KS1!","001i000000yoDjb","Xi-Iota","Kappa Sigma","Campaign Creator","Columbus State University","Kappa Sigma","Xi-Iota","Kappa Sigma - Xi-Iota"  ],
                ["KS-Alpha-Kappa","35kappasigma@greeks4good.com","KS1!","001i000000yoDgg","Alpha-Kappa","Kappa Sigma","Campaign Creator","Cornell University","Kappa Sigma","Alpha-Kappa","Kappa Sigma - Alpha-Kappa"  ],
                ["KS-Theta Prime","36kappasigma@greeks4good.com","KS1!","001i000000yoDkq","Theta Prime","Kappa Sigma","Campaign Creator","Cumberland University","Kappa Sigma","Theta Prime","Kappa Sigma - Theta Prime"  ],
                ["KS-Delta","37kappasigma@greeks4good.com","KS1!","001i000000yoDhn","Delta","Kappa Sigma","Campaign Creator","Davidson College","Kappa Sigma","Delta","Kappa Sigma - Delta"  ],
                ["KS-Lambda-Pi","38kappasigma@greeks4good.com","KS1!","001i000000yoDgH","Lambda-Pi","Kappa Sigma","Campaign Creator","Delta State University","Kappa Sigma","Lambda-Pi","Kappa Sigma - Lambda-Pi"  ],
                ["KS-Gamma-Xi","39kappasigma@greeks4good.com","KS1!","001i000000yoDjn","Gamma-Xi","Kappa Sigma","Campaign Creator","Denison University","Kappa Sigma","Gamma-Xi","Kappa Sigma - Gamma-Xi"  ],
                ["KS-Beta-Pi","40kappasigma@greeks4good.com","KS1!","001i000000yoDgt","Beta-Pi","Kappa Sigma","Campaign Creator","Dickinson College","Kappa Sigma","Beta-Pi","Kappa Sigma - Beta-Pi"  ],
                ["KS-Eta Prime","41kappasigma@greeks4good.com","KS1!","001i000000yoDhj","Eta Prime","Kappa Sigma","Campaign Creator","Duke University","Kappa Sigma","Eta Prime","Kappa Sigma - Eta Prime"  ],
                ["KS-Theta-Pi","42kappasigma@greeks4good.com","KS1!","001i000000yoDki","Theta-Pi","Kappa Sigma","Campaign Creator","East Carolina University","Kappa Sigma","Theta-Pi","Kappa Sigma - Theta-Pi"  ],
                ["KS-Lambda-Beta","43kappasigma@greeks4good.com","KS1!","001i000000yoDhx","Lambda-Beta","Kappa Sigma","Campaign Creator","East Tennessee State University","Kappa Sigma","Lambda-Beta","Kappa Sigma - Lambda-Beta"  ],
                ["KS-Eastern-Connecticut","44kappasigma@greeks4good.com","KS1!","001i000002DIhjs","Eastern Connecticut State University Colony","Kappa Sigma","Campaign Creator","Eastern Connecticut State University","Kappa Sigma","Eastern Connecticut State University Colony","Kappa Sigma - Eastern Connecticut State University Colony"  ],
                ["KS-Rho-Xi","45kappasigma@greeks4good.com","KS1!","001i000000yoDju","Rho-Xi","Kappa Sigma","Campaign Creator","Eastern Kentucky University","Kappa Sigma","Rho-Xi","Kappa Sigma - Rho-Xi"  ],
                ["KS-Upsilon-Delta","46kappasigma@greeks4good.com","KS1!","001i000001SHWsb","Upsilon-Delta","Kappa Sigma","Campaign Creator","Eastern Washington University","Kappa Sigma","Upsilon-Delta","Kappa Sigma - Upsilon-Delta"  ],
                ["KS-Lambda-Lambda","47kappasigma@greeks4good.com","KS1!","001i000000yoDkL","Lambda-Lambda","Kappa Sigma","Campaign Creator","Elon University","Kappa Sigma","Lambda-Lambda","Kappa Sigma - Lambda-Lambda"  ],
                ["KS-Omicron Colony","48kappasigma@greeks4good.com","KS1!","001i000000yoDil","Omicron Colony","Kappa Sigma","Campaign Creator","Emory & Henry College","Kappa Sigma","Omicron Colony","Kappa Sigma - Omicron Colony"  ],
                ["KS-Alpha","49kappasigma@greeks4good.com","KS1!","001i000000yoDjC","Alpha","Kappa Sigma","Campaign Creator","Emory University","Kappa Sigma","Alpha","Kappa Sigma - Alpha"  ],
                ["KS-Florida-Atlantic","50kappasigma@greeks4good.com","KS1!","001i000001fL3R9","Florida Atlantic University Colony","Kappa Sigma","Campaign Creator","Florida Atlantic University","Kappa Sigma","Florida Atlantic University Colony","Kappa Sigma - Florida Atlantic University Colony"  ],
                ["KS-Rho-Zeta","51kappasigma@greeks4good.com","KS1!","001i000000yoDfN","Rho-Zeta","Kappa Sigma","Campaign Creator","Florida Gulf Coast University","Kappa Sigma","Rho-Zeta","Kappa Sigma - Rho-Zeta"  ],
                ["KS-Xi-Kappa","52kappasigma@greeks4good.com","KS1!","001i000000yoDh3","Xi-Kappa Colony","Kappa Sigma","Campaign Creator","Florida International University","Kappa Sigma","Xi-Kappa Colony","Kappa Sigma - Xi-Kappa Colony"  ],
                ["KS-Epsilon-Sigma","53kappasigma@greeks4good.com","KS1!","001i000000yoDkd","Epsilon-Sigma","Kappa Sigma","Campaign Creator","Florida State University","Kappa Sigma","Epsilon-Sigma","Kappa Sigma - Epsilon-Sigma"  ],
                ["KS-Mu-Iota","54kappasigma@greeks4good.com","KS1!","001i000000yoDhZ","Mu-Iota","Kappa Sigma","Campaign Creator","Gallaudet University","Kappa Sigma","Mu-Iota","Kappa Sigma - Mu-Iota"  ],
                ["KS-Kappa-Phi","55kappasigma@greeks4good.com","KS1!","001i000000yoDk2","Kappa-Phi","Kappa Sigma","Campaign Creator","George Mason University","Kappa Sigma","Kappa-Phi","Kappa Sigma - Kappa-Phi"  ],
                ["KS-Lambda-Xi","56kappasigma@greeks4good.com","KS1!","001i000000yoDg1","Lambda-Xi","Kappa Sigma","Campaign Creator","Georgia College and State University","Kappa Sigma","Lambda-Xi","Kappa Sigma - Lambda-Xi"  ],
                ["KS-Kappa-Zeta","57kappasigma@greeks4good.com","KS1!","001i000000yoDk4","Kappa-Zeta","Kappa Sigma","Campaign Creator","Georgia Southern University","Kappa Sigma","Kappa-Zeta","Kappa Sigma - Kappa-Zeta"  ],
                ["KS-Kappa-Kappa","58kappasigma@greeks4good.com","KS1!","001i000000yoDkX","Kappa-Kappa","Kappa Sigma","Campaign Creator","Georgia Southwestern State University","Kappa Sigma","Kappa-Kappa","Kappa Sigma - Kappa-Kappa"  ],
                ["KS-Epsilon-Omega","59kappasigma@greeks4good.com","KS1!","001i000000yoDka","Epsilon-Omega","Kappa Sigma","Campaign Creator","Georgia State University","Kappa Sigma","Epsilon-Omega","Kappa Sigma - Epsilon-Omega"  ],
                ["KS-Tau-Epsilon","60kappasigma@greeks4good.com","KS1!","001i000000yoDeG","Tau-Epsilon","Kappa Sigma","Campaign Creator","Gonzaga University","Kappa Sigma","Tau-Epsilon","Kappa Sigma - Tau-Epsilon"  ],
                ["KS-Sigma-Kappa","61kappasigma@greeks4good.com","KS1!","001i000000yoDed","Sigma-Kappa","Kappa Sigma","Campaign Creator","Grand Valley State University","Kappa Sigma","Sigma-Kappa","Kappa Sigma - Sigma-Kappa"  ],
                ["KS-Upsilon Colony","62kappasigma@greeks4good.com","KS1!","001i000000yoDhd","Upsilon Colony","Kappa Sigma","Campaign Creator","Hampden-Sydney College","Kappa Sigma","Upsilon Colony","Kappa Sigma - Upsilon Colony"  ],
                ["KS-Tau-Phi","63kappasigma@greeks4good.com","KS1!","001i000000yoDde","Tau-Phi","Kappa Sigma","Campaign Creator","Hartwick College","Kappa Sigma","Tau-Phi","Kappa Sigma - Tau-Phi"  ],
                ["KS-Sigma-Gamma","64kappasigma@greeks4good.com","KS1!","001i000000yoDeq","Sigma-Gamma","Kappa Sigma","Campaign Creator","Henderson State University","Kappa Sigma","Sigma-Gamma","Kappa Sigma - Sigma-Gamma"  ],
                ["KS-Rho-Eta","65kappasigma@greeks4good.com","KS1!","001i000000yoDeX","Rho-Eta","Kappa Sigma","Campaign Creator","High Point University","Kappa Sigma","Rho-Eta","Kappa Sigma - Rho-Eta"  ],
                ["KS-Tau-Beta","66kappasigma@greeks4good.com","KS1!","001i000000yoDe5","Tau-Beta","Kappa Sigma","Campaign Creator","Humboldt State University","Kappa Sigma","Tau-Beta","Kappa Sigma - Tau-Beta"  ],
                ["KS-Xi-Omega","67kappasigma@greeks4good.com","KS1!","001i000000yoDhO","Xi-Omega","Kappa Sigma","Campaign Creator","Idaho State University","Kappa Sigma","Xi-Omega","Kappa Sigma - Xi-Omega"  ],
                ["KS-Illinois-State","68kappasigma@greeks4good.com","KS1!","001i000000yoDeY","Illinois State University Colony","Kappa Sigma","Campaign Creator","Illinois State University","Kappa Sigma","Illinois State University Colony","Kappa Sigma - Illinois State University Colony"  ],
                ["KS-Gamma-Lambda","69kappasigma@greeks4good.com","KS1!","001i000000yoDjW","Gamma-Lambda","Kappa Sigma","Campaign Creator","Iowa State University","Kappa Sigma","Gamma-Lambda","Kappa Sigma - Gamma-Lambda"  ],
                ["KS-Tau-Rho","70kappasigma@greeks4good.com","KS1!","001i000001BAboS","Tau-Rho","Kappa Sigma","Campaign Creator","Ithaca College","Kappa Sigma","Tau-Rho","Kappa Sigma - Tau-Rho"  ],
                ["KS-Lambda-Gamma","71kappasigma@greeks4good.com","KS1!","001i000000yoDjj","Lambda-Gamma","Kappa Sigma","Campaign Creator","Jacksonville State University","Kappa Sigma","Lambda-Gamma","Kappa Sigma - Lambda-Gamma"  ],
                ["KS-Lambda-Sigma","72kappasigma@greeks4good.com","KS1!","001i000000yoDkW","Lambda-Sigma","Kappa Sigma","Campaign Creator","James Madison University","Kappa Sigma","Lambda-Sigma","Kappa Sigma - Lambda-Sigma"  ],
                ["KS-Pi-Gamma","73kappasigma@greeks4good.com","KS1!","001i000000yoDf0","Pi-Gamma","Kappa Sigma","Campaign Creator","Johnson & Wales University-North Miami","Kappa Sigma","Pi-Gamma","Kappa Sigma - Pi-Gamma"  ],
                ["KS-Gamma-Chi","74kappasigma@greeks4good.com","KS1!","001i000000yoDjH","Gamma-Chi","Kappa Sigma","Campaign Creator","Kansas State University","Kappa Sigma","Gamma-Chi","Kappa Sigma - Gamma-Chi"  ],
                ["KS-Omicron-Kappa","75kappasigma@greeks4good.com","KS1!","001i000000yoDe8","Omicron-Kappa","Kappa Sigma","Campaign Creator","Kennesaw State University","Kappa Sigma","Omicron-Kappa","Kappa Sigma - Omicron-Kappa"  ],
                ["KS-Omicron-Omicron","76kappasigma@greeks4good.com","KS1!","001i000000yoDhD","Omicron-Omicron","Kappa Sigma","Campaign Creator","Kutztown University of Pennsylvania","Kappa Sigma","Omicron-Omicron","Kappa Sigma - Omicron-Omicron"  ],
                ["KS-Epsilon-Gamma","77kappasigma@greeks4good.com","KS1!","001i000000yoDjT","Epsilon-Gamma","Kappa Sigma","Campaign Creator","Louisiana Tech University","Kappa Sigma","Epsilon-Gamma","Kappa Sigma - Epsilon-Gamma"  ],
                ["KS-Lambda-Iota","78kappasigma@greeks4good.com","KS1!","001i000000yoDgA","Lambda-Iota","Kappa Sigma","Campaign Creator","Lyon College","Kappa Sigma","Lambda-Iota","Kappa Sigma - Lambda-Iota"  ],
                ["KS-Upsilon-Epsilon","79kappasigma@greeks4good.com","KS1!","001i000001rTcaL","Upsilon-Epsilon","Kappa Sigma","Campaign Creator","Marist College","Kappa Sigma","Upsilon-Epsilon","Kappa Sigma - Upsilon-Epsilon"  ],
                ["KS-Xi-Xi","80kappasigma@greeks4good.com","KS1!","001i000000yoDh5","Xi-Xi","Kappa Sigma","Campaign Creator","Marquette University","Kappa Sigma","Xi-Xi","Kappa Sigma - Xi-Xi"  ],
                ["KS-Tau-Nu","81kappasigma@greeks4good.com","KS1!","001i000000yoDdo","Tau-Nu","Kappa Sigma","Campaign Creator","Marshall University","Kappa Sigma","Tau-Nu","Kappa Sigma - Tau-Nu"  ],
                ["KS-Gamma-Pi","82kappasigma@greeks4good.com","KS1!","001i000000yoDkp","Gamma-Pi","Kappa Sigma","Campaign Creator","Massachusetts Institute of Technology","Kappa Sigma","Gamma-Pi","Kappa Sigma - Gamma-Pi"  ],
                ["KS-Theta-Rho","83kappasigma@greeks4good.com","KS1!","001i000000yoDja","Theta-Rho","Kappa Sigma","Campaign Creator","McNeese State University","Kappa Sigma","Theta-Rho","Kappa Sigma - Theta-Rho"  ],
                ["KS-Alpha-Beta","84kappasigma@greeks4good.com","KS1!","001i000000yoDk3","Alpha-Beta","Kappa Sigma","Campaign Creator","Mercer University","Kappa Sigma","Alpha-Beta","Kappa Sigma - Alpha-Beta"  ],
                ["KS-Merrimack College Colony","85kappasigma@greeks4good.com","KS1!","0010H00002JXqBM","Merrimack College Colony","Kappa Sigma","Campaign Creator","Merrimack College","Kappa Sigma","Merrimack College Colony","Kappa Sigma - Merrimack College Colony"  ],
                ["KS-Pi-Mu Colony","86kappasigma@greeks4good.com","KS1!","001i000000yoDjs","Pi-Mu Colony","Kappa Sigma","Campaign Creator","Methodist University","Kappa Sigma","Pi-Mu Colony","Kappa Sigma - Pi-Mu Colony"  ],
                ["KS-Delta-Psi","87kappasigma@greeks4good.com","KS1!","001i000000yoDkY","Delta-Psi","Kappa Sigma","Campaign Creator","Michigan State University","Kappa Sigma","Delta-Psi","Kappa Sigma - Delta-Psi"  ],
                ["KS-Kappa-Iota","88kappasigma@greeks4good.com","KS1!","001i000000yoDiW","Kappa-Iota","Kappa Sigma","Campaign Creator","Middle Tennessee State University","Kappa Sigma","Kappa-Iota","Kappa Sigma - Kappa-Iota"  ],
                ["KS-Theta-Gamma","89kappasigma@greeks4good.com","KS1!","001i000000yoDgN","Theta-Gamma","Kappa Sigma","Campaign Creator","Midwestern State University","Kappa Sigma","Theta-Gamma","Kappa Sigma - Theta-Gamma"  ],
                ["KS-Alpha-Upsilon","90kappasigma@greeks4good.com","KS1!","001i000000yoDjQ","Alpha-Upsilon","Kappa Sigma","Campaign Creator","Millsaps College","Kappa Sigma","Alpha-Upsilon","Kappa Sigma - Alpha-Upsilon"  ],
                ["KS-Sigma-Sigma","91kappasigma@greeks4good.com","KS1!","001i000000yoDep","Sigma-Sigma","Kappa Sigma","Campaign Creator","Minnesota State University Moorhead","Kappa Sigma","Sigma-Sigma","Kappa Sigma - Sigma-Sigma"  ],
                ["KS-Delta-Chi","92kappasigma@greeks4good.com","KS1!","001i000000yoDgF","Delta-Chi","Kappa Sigma","Campaign Creator","Mississippi State University","Kappa Sigma","Delta-Chi","Kappa Sigma - Delta-Chi"  ],
                ["KS-Pi-Eta","93kappasigma@greeks4good.com","KS1!","001i000000yoDf1","Pi-Eta","Kappa Sigma","Campaign Creator","Missouri Southern State University","Kappa Sigma","Pi-Eta","Kappa Sigma - Pi-Eta"  ],
                ["KS-Beta-Chi","94kappasigma@greeks4good.com","KS1!","001i000000yoDiA","Beta-Chi","Kappa Sigma","Campaign Creator","Missouri University of Science and Technology","Kappa Sigma","Beta-Chi","Kappa Sigma - Beta-Chi"  ],
                ["KS-West-Long","95kappasigma@greeks4good.com","KS1!","001i0000029KRGA","West Long Branch, NJ Colony","Kappa Sigma","Campaign Creator","Monmouth University","Kappa Sigma","West Long Branch, NJ Colony","Kappa Sigma - West Long Branch, NJ Colony"  ],
                ["KS-Delta-Lambda","96kappasigma@greeks4good.com","KS1!","001i000000yoDk0","Delta-Lambda","Kappa Sigma","Campaign Creator","Montana State University","Kappa Sigma","Delta-Lambda","Kappa Sigma - Delta-Lambda"  ],
                ["KS-Tau-Omega","97kappasigma@greeks4good.com","KS1!","001i000001QMoWI","Tau-Omega","Kappa Sigma","Campaign Creator","Montclair State University","Kappa Sigma","Tau-Omega","Kappa Sigma - Tau-Omega"  ],
                ["KS-Nu-Theta","98kappasigma@greeks4good.com","KS1!","001i000000yoDkM","Nu-Theta","Kappa Sigma","Campaign Creator","Morehead State University","Kappa Sigma","Nu-Theta","Kappa Sigma - Nu-Theta"  ],
                ["KS-Theta-Omicron","99kappasigma@greeks4good.com","KS1!","001i000000yoDdl","Theta-Omicron","Kappa Sigma","Campaign Creator","Muskingum University","Kappa Sigma","Theta-Omicron","Kappa Sigma - Theta-Omicron"  ],
                ["KS-Pi-Tau","100kappasigma@greeks4good.com","KS1!","001i000000yoDf6","Pi-Tau","Kappa Sigma","Campaign Creator","New Mexico Institute of Mining and Technology","Kappa Sigma","Pi-Tau","Kappa Sigma - Pi-Tau"  ],
                ["KS-Gamma-Zeta","101kappasigma@greeks4good.com","KS1!","001i000000yoDfr","Gamma-Zeta","Kappa Sigma","Campaign Creator","New York University","Kappa Sigma","Gamma-Zeta","Kappa Sigma - Gamma-Zeta"  ],
                ["KS-Omicron-Chi","102kappasigma@greeks4good.com","KS1!","001i000000yoDhC","Omicron-Chi","Kappa Sigma","Campaign Creator","Nicholls State University","Kappa Sigma","Omicron-Chi","Kappa Sigma - Omicron-Chi"  ],
                ["KS-Nu-Phi","103kappasigma@greeks4good.com","KS1!","001i000000yoDjt","Nu-Phi","Kappa Sigma","Campaign Creator","Northeastern State University","Kappa Sigma","Nu-Phi","Kappa Sigma - Nu-Phi"  ],
                ["KS-Xi-Beta","104kappasigma@greeks4good.com","KS1!","001i000000yoDh1","Xi-Beta","Kappa Sigma","Campaign Creator","Northeastern University","Kappa Sigma","Xi-Beta","Kappa Sigma - Xi-Beta"  ],
                ["KS-Theta-Mu","105kappasigma@greeks4good.com","KS1!","001i000000yoDk1","Theta-Mu","Kappa Sigma","Campaign Creator","Northwestern State University of Louisiana","Kappa Sigma","Theta-Mu","Kappa Sigma - Theta-Mu"  ],
                ["KS-Sigma-Zeta","106kappasigma@greeks4good.com","KS1!","001i000000yoDen","Sigma-Zeta","Kappa Sigma","Campaign Creator","Northwood University","Kappa Sigma","Sigma-Zeta","Kappa Sigma - Sigma-Zeta"  ],
                ["KS-Omicron-Eta","107kappasigma@greeks4good.com","KS1!","001i000000yoDhS","Omicron-Eta","Kappa Sigma","Campaign Creator","Nova Southeastern University","Kappa Sigma","Omicron-Eta","Kappa Sigma - Omicron-Eta"  ],
                ["KS-Theta-Psi","108kappasigma@greeks4good.com","KS1!","001i000000yoDiI","Theta-Psi","Kappa Sigma","Campaign Creator","Oklahoma City University","Kappa Sigma","Theta-Psi","Kappa Sigma - Theta-Psi"  ],
                ["KS-Sigma-Theta","109kappasigma@greeks4good.com","KS1!","001i000000yoDel","Sigma-Theta","Kappa Sigma","Campaign Creator","Old Dominion University","Kappa Sigma","Sigma-Theta","Kappa Sigma - Sigma-Theta"  ],
                ["KS-Gamma-Sigma","110kappasigma@greeks4good.com","KS1!","001i000000yoDjg","Gamma-Sigma","Kappa Sigma","Campaign Creator","Oregon State University","Kappa Sigma","Gamma-Sigma","Kappa Sigma - Gamma-Sigma"  ],
                ["KS-Theta-Epsilon","111kappasigma@greeks4good.com","KS1!","001i000000yoDj2","Theta-Epsilon","Kappa Sigma","Campaign Creator","Portland State University","Kappa Sigma","Theta-Epsilon","Kappa Sigma - Theta-Epsilon"  ],
                ["KS-Pi-Nu","112kappasigma@greeks4good.com","KS1!","001i000000yoDf8","Pi-Nu","Kappa Sigma","Campaign Creator","Ramapo College of New Jersey","Kappa Sigma","Pi-Nu","Kappa Sigma - Pi-Nu"  ],
                ["KS-Eta","113kappasigma@greeks4good.com","KS1!","001i000000yoDjk","Eta","Kappa Sigma","Campaign Creator","Randolph-Macon College","Kappa Sigma","Eta","Kappa Sigma - Eta"  ],
                ["KS-West-Denver","114kappasigma@greeks4good.com","KS1!","0010H00002ONS59","West Denver, Colorado Colony","Kappa Sigma","Campaign Creator","Regis University","Kappa Sigma","West Denver, Colorado Colony","Kappa Sigma - West Denver, Colorado Colony"  ],
                ["KS-Upsilon-Alpha","115kappasigma@greeks4good.com","KS1!","001i000000yoDkv","Upsilon-Alpha","Kappa Sigma","Campaign Creator","Reinhardt University","Kappa Sigma","Upsilon-Alpha","Kappa Sigma - Upsilon-Alpha"  ],
                ["KS-Rhode-Island-College","116kappasigma@greeks4good.com","KS1!","001i000001KiGdd","Rhode Island College Colony","Kappa Sigma","Campaign Creator","Rhode Island College","Kappa Sigma","Rhode Island College Colony","Kappa Sigma - Rhode Island College Colony"  ],
                ["KS-Phi","117kappasigma@greeks4good.com","KS1!","001i000000yoDkA","Phi","Kappa Sigma","Campaign Creator","Rhodes College","Kappa Sigma","Phi","Kappa Sigma - Phi"  ],
                ["KS-Nu-Iota","118kappasigma@greeks4good.com","KS1!","001i000000yoDgr","Nu-Iota Colony","Kappa Sigma","Campaign Creator","Rowan University","Kappa Sigma","Nu-Iota Colony","Kappa Sigma - Nu-Iota Colony"  ],
                ["KS-Rutgers","119kappasigma@greeks4good.com","KS1!","001i000002BFvW6","Rutgers University-Newark Colony","Kappa Sigma","Campaign Creator","Rutgers University-Newark","Kappa Sigma","Rutgers University-Newark Colony","Kappa Sigma - Rutgers University-Newark Colony"  ],
                ["KS-Pi-Omega","120kappasigma@greeks4good.com","KS1!","001i000000yoDeP","Pi-Omega","Kappa Sigma","Campaign Creator","Sacred Heart University","Kappa Sigma","Pi-Omega","Kappa Sigma - Pi-Omega"  ],
                ["KS-Upsilon-Theta","121kappasigma@greeks4good.com","KS1!","001i000001fJHVj","Upsilon-Theta","Kappa Sigma","Campaign Creator","Saint Leo University","Kappa Sigma","Upsilon-Theta","Kappa Sigma - Upsilon-Theta"  ],
                ["KS-Pi-Sigma","122kappasigma@greeks4good.com","KS1!","001i000000yoDfH","Pi-Sigma","Kappa Sigma","Campaign Creator","Salisbury University","Kappa Sigma","Pi-Sigma","Kappa Sigma - Pi-Sigma"  ],
                ["KS-Lambda-Phi","123kappasigma@greeks4good.com","KS1!","001i000000yoDfo","Lambda-Phi","Kappa Sigma","Campaign Creator","Sam Houston State University","Kappa Sigma","Lambda-Phi","Kappa Sigma - Lambda-Phi"  ],
                ["KS-Epsilon-Iota","124kappasigma@greeks4good.com","KS1!","001i000000yoDj9","Epsilon-Iota","Kappa Sigma","Campaign Creator","San Diego State University","Kappa Sigma","Epsilon-Iota","Kappa Sigma - Epsilon-Iota"  ],
                ["KS-Tau-Pi","125kappasigma@greeks4good.com","KS1!","001i000000yoDdU","Tau-Pi","Kappa Sigma","Campaign Creator","San Francisco State University","Kappa Sigma","Tau-Pi","Kappa Sigma - Tau-Pi"  ],
                ["KS-Theta-Iota","126kappasigma@greeks4good.com","KS1!","001i000000yoDkk","Theta-Iota","Kappa Sigma","Campaign Creator","San Jose State University","Kappa Sigma","Theta-Iota","Kappa Sigma - Theta-Iota"  ],
                ["KS-Sigma-Omega","127kappasigma@greeks4good.com","KS1!","001i000000yoDdh","Sigma-Omega","Kappa Sigma","Campaign Creator","Santa Clara University","Kappa Sigma","Sigma-Omega","Kappa Sigma - Sigma-Omega"  ],
                ["KS-Omicron-Sigma","128kappasigma@greeks4good.com","KS1!","001i000000yoDeD","Omicron-Sigma","Kappa Sigma","Campaign Creator","Slippery Rock University of Pennsylvania","Kappa Sigma","Omicron-Sigma","Kappa Sigma - Omicron-Sigma"  ],
                ["KS-Mu-Omega","129kappasigma@greeks4good.com","KS1!","001i000000yoDgJ","Mu-Omega","Kappa Sigma","Campaign Creator","Southeastern Louisiana University","Kappa Sigma","Mu-Omega","Kappa Sigma - Mu-Omega"  ],
                ["KS-Delta-Pi","130kappasigma@greeks4good.com","KS1!","001i000000yoDkU","Delta-Pi","Kappa Sigma","Campaign Creator","Southern Methodist University","Kappa Sigma","Delta-Pi","Kappa Sigma - Delta-Pi"  ],
                ["KS-Southern-Oregon","131kappasigma@greeks4good.com","KS1!","001i000001qGi2Z","Southern Oregon Colony","Kappa Sigma","Campaign Creator","Southern Oregon University","Kappa Sigma","Southern Oregon Colony","Kappa Sigma - Southern Oregon Colony"  ],
                ["KS-Iota","132kappasigma@greeks4good.com","KS1!","001i000000yoDfQ","Iota","Kappa Sigma","Campaign Creator","Southwestern University","Kappa Sigma","Iota","Kappa Sigma - Iota"  ],
                ["KS-Beta-Zeta","133kappasigma@greeks4good.com","KS1!","001i000000yoDj4","Beta-Zeta","Kappa Sigma","Campaign Creator","Stanford University","Kappa Sigma","Beta-Zeta","Kappa Sigma - Beta-Zeta"  ],
                ["KS-Xi-Gamma","134kappasigma@greeks4good.com","KS1!","001i000000yoDgd","Xi-Gamma","Kappa Sigma","Campaign Creator","State University of New York at New Paltz","Kappa Sigma","Xi-Gamma","Kappa Sigma - Xi-Gamma"  ],
                ["KS-Rho-Omega","135kappasigma@greeks4good.com","KS1!","001i000000yoDjL","Rho-Omega","Kappa Sigma","Campaign Creator","Stevens Institute of Technology","Kappa Sigma","Rho-Omega","Kappa Sigma - Rho-Omega"  ],
                ["KS-Xi-Rho","136kappasigma@greeks4good.com","KS1!","001i000000yoDge","Xi-Rho","Kappa Sigma","Campaign Creator","Stockton University","Kappa Sigma","Xi-Rho","Kappa Sigma - Xi-Rho"  ],
                ["KS-Sigma-Delta","137kappasigma@greeks4good.com","KS1!","001i000000yoDdz","Sigma-Delta","Kappa Sigma","Campaign Creator","Stony Brook University","Kappa Sigma","Sigma-Delta","Kappa Sigma - Sigma-Delta"  ],
                ["KS-Omicron-Upsilon","138kappasigma@greeks4good.com","KS1!","001i000000yoDeH","Omicron-Upsilon","Kappa Sigma","Campaign Creator","Temple University","Kappa Sigma","Omicron-Upsilon","Kappa Sigma - Omicron-Upsilon"  ],
                ["KS-Kappa-Mu","139kappasigma@greeks4good.com","KS1!","001i000000yoDhX","Kappa-Mu","Kappa Sigma","Campaign Creator","Tennessee Technological University","Kappa Sigma","Kappa-Mu","Kappa Sigma - Kappa-Mu"  ],
                ["KS-Theta","140kappasigma@greeks4good.com","KS1!","001i000000yoDgM","Theta","Kappa Sigma","Campaign Creator","Texas Christian University","Kappa Sigma","Theta","Kappa Sigma - Theta"  ],
                ["KS-Theta-Lambda","141kappasigma@greeks4good.com","KS1!","001i000000yoDkF","Theta-Lambda","Kappa Sigma","Campaign Creator","Texas State University","Kappa Sigma","Theta-Lambda","Kappa Sigma - Theta-Lambda"  ],
                ["KS-Rho-Gamma","142kappasigma@greeks4good.com","KS1!","001i000000yoDfM","Rho-Gamma","Kappa Sigma","Campaign Creator","Texas Woman's University","Kappa Sigma","Rho-Gamma","Kappa Sigma - Rho-Gamma"  ],
                ["KS-Beta","143kappasigma@greeks4good.com","KS1!","001i000000yoDgB","Beta","Kappa Sigma","Campaign Creator","The University of Alabama","Kappa Sigma","Beta","Kappa Sigma - Beta"  ],
                ["KS-Theta-Omega","144kappasigma@greeks4good.com","KS1!","001i000000yoDgO","Theta-Omega","Kappa Sigma","Campaign Creator","The University of Texas at Arlington","Kappa Sigma","Theta-Omega","Kappa Sigma - Theta-Omega"  ],
                ["KS-Tau","145kappasigma@greeks4good.com","KS1!","001i000000yoDfR","Tau","Kappa Sigma","Campaign Creator","The University of Texas at Austin","Kappa Sigma","Tau","Kappa Sigma - Tau"  ],
                ["KS-Nu-Omicron","146kappasigma@greeks4good.com","KS1!","001i000000yoDgQ","Nu-Omicron","Kappa Sigma","Campaign Creator","The University of Texas at Dallas","Kappa Sigma","Nu-Omicron","Kappa Sigma - Nu-Omicron"  ],
                ["KS-Xi-Delta","147kappasigma@greeks4good.com","KS1!","001i000000yoDfp","Xi-Delta","Kappa Sigma","Campaign Creator","The University of Texas at San Antonio","Kappa Sigma","Xi-Delta","Kappa Sigma - Xi-Delta"  ],
                ["KS-Pi-Delta","148kappasigma@greeks4good.com","KS1!","001i000000yoDez","Pi-Delta","Kappa Sigma","Campaign Creator","The University of Virginia's College at Wise","Kappa Sigma","Pi-Delta","Kappa Sigma - Pi-Delta"  ],
                ["KS-Xi-Epsilon","149kappasigma@greeks4good.com","KS1!","001i000000yoDjD","Xi-Epsilon","Kappa Sigma","Campaign Creator","Thiel College","Kappa Sigma","Xi-Epsilon","Kappa Sigma - Xi-Epsilon"  ],
                ["KS-Mu-Sigma","150kappasigma@greeks4good.com","KS1!","001i000000yoDha","Mu-Sigma","Kappa Sigma","Campaign Creator","Towson University","Kappa Sigma","Mu-Sigma","Kappa Sigma - Mu-Sigma"  ],
                ["KS-Theta-Xi","151kappasigma@greeks4good.com","KS1!","001i000000yoDg6","Theta-Xi","Kappa Sigma","Campaign Creator","Trine University","Kappa Sigma","Theta-Xi","Kappa Sigma - Theta-Xi"  ],
                ["KS-Sigma-Alpha","152kappasigma@greeks4good.com","KS1!","001i000000yoDe0","Sigma-Alpha","Kappa Sigma","Campaign Creator","Trinity College","Kappa Sigma","Sigma-Alpha","Kappa Sigma - Sigma-Alpha"  ],
                ["KS-Gamma-Rho","153kappasigma@greeks4good.com","KS1!","001i000000yoDiu","Gamma-Rho","Kappa Sigma","Campaign Creator","University of Arizona","Kappa Sigma","Gamma-Rho","Kappa Sigma - Gamma-Rho"  ],
                ["KS-Xi","154kappasigma@greeks4good.com","KS1!","001i000000yoDhY","Xi","Kappa Sigma","Campaign Creator","University of Arkansas","Kappa Sigma","Xi","Kappa Sigma - Xi"  ],
                ["KS-Theta-Eta","155kappasigma@greeks4good.com","KS1!","001i000000yoDg9","Theta-Eta","Kappa Sigma","Campaign Creator","University of Arkansas at Little Rock","Kappa Sigma","Theta-Eta","Kappa Sigma - Theta-Eta"  ],
                ["KS-Omicron-Tau","156kappasigma@greeks4good.com","KS1!","001i000000yoDgU","Omicron-Tau","Kappa Sigma","Campaign Creator","University of Arkansas-Fort Smith","Kappa Sigma","Omicron-Tau","Kappa Sigma - Omicron-Tau"  ],
                ["KS-Nu-Kappa","157kappasigma@greeks4good.com","KS1!","001i000000yoDjS","Nu-Kappa","Kappa Sigma","Campaign Creator","University of Central Arkansas","Kappa Sigma","Nu-Kappa","Kappa Sigma - Nu-Kappa"  ],
                ["KS-Lambda-Epsilon","158kappasigma@greeks4good.com","KS1!","001i000000yoDkn","Lambda-Epsilon","Kappa Sigma","Campaign Creator","University of Central Florida","Kappa Sigma","Lambda-Epsilon","Kappa Sigma - Lambda-Epsilon"  ],
                ["KS-Gamma-Tau","159kappasigma@greeks4good.com","KS1!","001i000000yoDfX","Gamma-Tau","Kappa Sigma","Campaign Creator","University of Colorado Boulder","Kappa Sigma","Gamma-Tau","Kappa Sigma - Gamma-Tau"  ],
                ["KS-Xi-Lambda","160kappasigma@greeks4good.com","KS1!","001i000000yoDk8","Xi-Lambda","Kappa Sigma","Campaign Creator","University of Delaware","Kappa Sigma","Xi-Lambda","Kappa Sigma - Xi-Lambda"  ],
                ["KS-Delta-Delta","161kappasigma@greeks4good.com","KS1!","001i000000yoDg3","Delta-Delta","Kappa Sigma","Campaign Creator","University of Florida","Kappa Sigma","Delta-Delta","Kappa Sigma - Delta-Delta"  ],
                ["KS-Beta-Lambda","162kappasigma@greeks4good.com","KS1!","001i000000yoDk6","Beta-Lambda","Kappa Sigma","Campaign Creator","University of Georgia","Kappa Sigma","Beta-Lambda","Kappa Sigma - Beta-Lambda"  ],
                ["KS-Pi-Epsilon","163kappasigma@greeks4good.com","KS1!","001i000000yoDeA","Pi-Epsilon","Kappa Sigma","Campaign Creator","University of Houston","Kappa Sigma","Pi-Epsilon","Kappa Sigma - Pi-Epsilon"  ],
                ["KS-Gamma-Theta","164kappasigma@greeks4good.com","KS1!","001i000000yoDkE","Gamma-Theta","Kappa Sigma","Campaign Creator","University of Idaho","Kappa Sigma","Gamma-Theta","Kappa Sigma - Gamma-Theta"  ],
                ["KS-Alpha-Gamma","165kappasigma@greeks4good.com","KS1!","001i000000yoDiP","Alpha-Gamma","Kappa Sigma","Campaign Creator","University of Illinois at Urbana-Champaign","Kappa Sigma","Alpha-Gamma","Kappa Sigma - Alpha-Gamma"  ],
                ["KS-Beta-Rho","166kappasigma@greeks4good.com","KS1!","001i000000yoDdt","Beta-Rho","Kappa Sigma","Campaign Creator","University of Iowa","Kappa Sigma","Beta-Rho","Kappa Sigma - Beta-Rho"  ],
                ["KS-Gamma-Omicron","167kappasigma@greeks4good.com","KS1!","001i000000yoDiE","Gamma-Omicron","Kappa Sigma","Campaign Creator","University of Kansas","Kappa Sigma","Gamma-Omicron","Kappa Sigma - Gamma-Omicron"  ],
                ["KS-Beta-Nu","168kappasigma@greeks4good.com","KS1!","001i000000yoDia","Beta-Nu","Kappa Sigma","Campaign Creator","University of Kentucky","Kappa Sigma","Beta-Nu","Kappa Sigma - Beta-Nu"  ],
                ["KS-Mu-Eta","169kappasigma@greeks4good.com","KS1!","001i000000yoDjN","Mu-Eta","Kappa Sigma","Campaign Creator","University of Louisville","Kappa Sigma","Mu-Eta","Kappa Sigma - Mu-Eta"  ],
                ["KS-Psi","170kappasigma@greeks4good.com","KS1!","001i000000yoDi2","Psi","Kappa Sigma","Campaign Creator","University of Maine","Kappa Sigma","Psi","Kappa Sigma - Psi"  ],
                ["KS-Rho-Chi","171kappasigma@greeks4good.com","KS1!","001i000000yoDer","Rho-Chi","Kappa Sigma","Campaign Creator","University of Mary Washington","Kappa Sigma","Rho-Chi","Kappa Sigma - Rho-Chi"  ],
                ["KS-Epsilon-Pi","172kappasigma@greeks4good.com","KS1!","001i000000yoDg8","Epsilon-Pi","Kappa Sigma","Campaign Creator","University of Memphis","Kappa Sigma","Epsilon-Pi","Kappa Sigma - Epsilon-Pi"  ],
                ["KS-Epsilon-Beta","173kappasigma@greeks4good.com","KS1!","001i000000yoDg4","Epsilon-Beta","Kappa Sigma","Campaign Creator","University of Miami","Kappa Sigma","Epsilon-Beta","Kappa Sigma - Epsilon-Beta"  ],
                ["KS-Omicron-Rho","174kappasigma@greeks4good.com","KS1!","001i000000yoDga","Omicron-Rho","Kappa Sigma","Campaign Creator","University of Michigan-Flint","Kappa Sigma","Omicron-Rho","Kappa Sigma - Omicron-Rho"  ],
                ["KS-Beta-Mu","175kappasigma@greeks4good.com","KS1!","001i000000yoDiB","Beta-Mu","Kappa Sigma","Campaign Creator","University of Minnesota-Twin Cities","Kappa Sigma","Beta-Mu","Kappa Sigma - Beta-Mu"  ],
                ["KS-Delta-Xi","176kappasigma@greeks4good.com","KS1!","001i000000yoDkf","Delta-Xi","Kappa Sigma","Campaign Creator","University of Mississippi","Kappa Sigma","Delta-Xi","Kappa Sigma - Delta-Xi"  ],
                ["KS-Alpha-Psi","177kappasigma@greeks4good.com","KS1!","001i000000yoDiG","Alpha-Psi","Kappa Sigma","Campaign Creator","University of Nebraska-Lincoln","Kappa Sigma","Alpha-Psi","Kappa Sigma - Alpha-Psi"  ],
                ["KS-West-Haven","178kappasigma@greeks4good.com","KS1!","0010H00002JUgYc","West Haven, Connecticut Colony","Kappa Sigma","Campaign Creator","University of New Haven","Kappa Sigma","West Haven, Connecticut Colony","Kappa Sigma - West Haven, Connecticut Colony"  ],
                ["KS-Rho-Theta","179kappasigma@greeks4good.com","KS1!","001i000000yoDeB","Rho-Theta","Kappa Sigma","Campaign Creator","University of New Orleans","Kappa Sigma","Rho-Theta","Kappa Sigma - Rho-Theta"  ],
                ["KS-Lambda-Omicron","180kappasigma@greeks4good.com","KS1!","001i000000yoDjV","Lambda-Omicron","Kappa Sigma","Campaign Creator","University of North Alabama","Kappa Sigma","Lambda-Omicron","Kappa Sigma - Lambda-Omicron"  ],
                ["KS-Kappa-Omega","181kappasigma@greeks4good.com","KS1!","001i000000yoDhl","Kappa-Omega","Kappa Sigma","Campaign Creator","University of North Carolina at Charlotte","Kappa Sigma","Kappa-Omega","Kappa Sigma - Kappa-Omega"  ],
                ["KS-Delta-Mu","182kappasigma@greeks4good.com","KS1!","001i000000yoDiC","Delta-Mu","Kappa Sigma","Campaign Creator","University of North Dakota","Kappa Sigma","Delta-Mu","Kappa Sigma - Delta-Mu"  ],
                ["KS-Xi-Psi","183kappasigma@greeks4good.com","KS1!","001i000000yoDjf","Xi-Psi","Kappa Sigma","Campaign Creator","University of North Florida","Kappa Sigma","Xi-Psi","Kappa Sigma - Xi-Psi"  ],
                ["KS-Rho Prime","184kappasigma@greeks4good.com","KS1!","001i000000yoDk7","Rho Prime","Kappa Sigma","Campaign Creator","University of North Georgia","Kappa Sigma","Rho Prime","Kappa Sigma - Rho Prime"  ],
                ["KS-Mu-Upsilon","185kappasigma@greeks4good.com","KS1!","001i000000yoDkc","Mu-Upsilon","Kappa Sigma","Campaign Creator","University of Northern Iowa","Kappa Sigma","Mu-Upsilon","Kappa Sigma - Mu-Upsilon"  ],
                ["KS-Gamma-Alpha","186kappasigma@greeks4good.com","KS1!","001i000000yoDj0","Gamma-Alpha","Kappa Sigma","Campaign Creator","University of Oregon","Kappa Sigma","Gamma-Alpha","Kappa Sigma - Gamma-Alpha"  ],
                ["KS-Alpha-Epsilon","187kappasigma@greeks4good.com","KS1!","001i000000yoDgx","Alpha-Epsilon","Kappa Sigma","Campaign Creator","University of Pennsylvania","Kappa Sigma","Alpha-Epsilon","Kappa Sigma - Alpha-Epsilon"  ],
                ["KS-Tau-Eta","188kappasigma@greeks4good.com","KS1!","001i000000yoDeE","Tau-Eta","Kappa Sigma","Campaign Creator","University of Rhode Island","Kappa Sigma","Tau-Eta","Kappa Sigma - Tau-Eta"  ],
                ["KS-Beta-Beta Colony","189kappasigma@greeks4good.com","KS1!","001i000000yoDhe","Beta-Beta Colony","Kappa Sigma","Campaign Creator","University of Richmond","Kappa Sigma","Beta-Beta Colony","Kappa Sigma - Beta-Beta Colony"  ],
                ["KS-Kappa-Nu","190kappasigma@greeks4good.com","KS1!","001i000000yoDgC","Kappa-Nu","Kappa Sigma","Campaign Creator","University of South Alabama","Kappa Sigma","Kappa-Nu","Kappa Sigma - Kappa-Nu"  ],
                ["KS-Delta-Eta","191kappasigma@greeks4good.com","KS1!","001i000000yoDi7","Delta-Eta","Kappa Sigma","Campaign Creator","University of Southern California","Kappa Sigma","Delta-Eta","Kappa Sigma - Delta-Eta"  ],
                ["KS-Epsilon-Nu","192kappasigma@greeks4good.com","KS1!","001i000000yoDgG","Epsilon-Nu","Kappa Sigma","Campaign Creator","University of Southern Mississippi","Kappa Sigma","Epsilon-Nu","Kappa Sigma - Epsilon-Nu"  ],
                ["KS-University-Toledo","193kappasigma@greeks4good.com","KS1!","001i000002BFva8","University of Toledo Colony","Kappa Sigma","Campaign Creator","University of Toledo","Kappa Sigma","University of Toledo Colony","Kappa Sigma - University of Toledo Colony"  ],
                ["KS-Alpha-Lambda","194kappasigma@greeks4good.com","KS1!","001i000000yoDjw","Alpha-Lambda","Kappa Sigma","Campaign Creator","University of Vermont","Kappa Sigma","Alpha-Lambda","Kappa Sigma - Alpha-Lambda"  ],
                ["KS-Lambda-Delta","195kappasigma@greeks4good.com","KS1!","001i000000yoDkl","Lambda-Delta","Kappa Sigma","Campaign Creator","University of West Georgia","Kappa Sigma","Lambda-Delta","Kappa Sigma - Lambda-Delta"  ],
                ["KS-Beta-Epsilon","196kappasigma@greeks4good.com","KS1!","001i000000yoDkH","Beta-Epsilon","Kappa Sigma","Campaign Creator","University of Wisconsin-Madison","Kappa Sigma","Beta-Epsilon","Kappa Sigma - Beta-Epsilon"  ],
                ["KS-Tau-Tau","197kappasigma@greeks4good.com","KS1!","001i000000yoDgb","Tau-Tau","Kappa Sigma","Campaign Creator","University of Wisconsin-Milwaukee","Kappa Sigma","Tau-Tau","Kappa Sigma - Tau-Tau"  ],
                ["KS-Delta-Gamma","198kappasigma@greeks4good.com","KS1!","001i000000yoDfY","Delta-Gamma Colony","Kappa Sigma","Campaign Creator","University of Wyoming","Kappa Sigma","Delta-Gamma Colony","Kappa Sigma - Delta-Gamma Colony"  ],
                ["KS-Kappa","199kappasigma@greeks4good.com","KS1!","001i000000yoDiV","Kappa","Kappa Sigma","Campaign Creator","Vanderbilt University","Kappa Sigma","Kappa","Kappa Sigma - Kappa"  ],
                ["KS-Alpha-Pi","200kappasigma@greeks4good.com","KS1!","001i000000yoDiN","Alpha-Pi","Kappa Sigma","Campaign Creator","Wabash College","Kappa Sigma","Alpha-Pi","Kappa Sigma - Alpha-Pi"  ],
                ["KS-Gamma-Nu","201kappasigma@greeks4good.com","KS1!","001i000000yoDjm","Gamma-Nu","Kappa Sigma","Campaign Creator","Washburn University","Kappa Sigma","Gamma-Nu","Kappa Sigma - Gamma-Nu"  ],
                ["KS-Mu","202kappasigma@greeks4good.com","KS1!","001i000000yoDhh","Mu","Kappa Sigma","Campaign Creator","Washington and Lee University","Kappa Sigma","Mu","Kappa Sigma - Mu"  ],
                ["KS-Omicron-Phi","203kappasigma@greeks4good.com","KS1!","001i000000yoDey","Omicron-Phi","Kappa Sigma","Campaign Creator","Washington College","Kappa Sigma","Omicron-Phi","Kappa Sigma - Omicron-Phi"  ],
                ["KS-Gamma-Mu","204kappasigma@greeks4good.com","KS1!","001i000000yoDix","Gamma-Mu","Kappa Sigma","Campaign Creator","Washington State University","Kappa Sigma","Gamma-Mu","Kappa Sigma - Gamma-Mu"  ],
                ["KS-Theta-Theta","205kappasigma@greeks4good.com","KS1!","001i000000yoDkP","Theta-Theta","Kappa Sigma","Campaign Creator","Western Kentucky University","Kappa Sigma","Theta-Theta","Kappa Sigma - Theta-Theta"  ],
                ["KS-Sigma-Tau","206kappasigma@greeks4good.com","KS1!","001i000000yoDe6","Sigma-Tau","Kappa Sigma","Campaign Creator","Western Oregon University","Kappa Sigma","Sigma-Tau","Kappa Sigma - Sigma-Tau"  ],
                ["KS-Kappa-Eta","207kappasigma@greeks4good.com","KS1!","001i000000yoDgv","Kappa-Eta","Kappa Sigma","Campaign Creator","Widener University","Kappa Sigma","Kappa-Eta","Kappa Sigma - Kappa-Eta"  ],
                ["KS-Theta-Delta","208kappasigma@greeks4good.com","KS1!","001i000000yoDj1","Theta-Delta","Kappa Sigma","Campaign Creator","Willamette University","Kappa Sigma","Theta-Delta","Kappa Sigma - Theta-Delta"  ],
                ["KS-Alpha-Nu","209kappasigma@greeks4good.com","KS1!","001i000000yoDjc","Alpha-Nu","Kappa Sigma","Campaign Creator","Wofford College","Kappa Sigma","Alpha-Nu","Kappa Sigma - Alpha-Nu"  ],
                ["KS-Rho-Pi","210kappasigma@greeks4good.com","KS1!","001i000000yoDeb","Rho-Pi","Kappa Sigma","Campaign Creator","Young Harris College","Kappa Sigma","Rho-Pi","Kappa Sigma - Rho-Pi"  ],
                ["KS-Alpha-Delta","211kappasigma@greeks4good.com","KS1!","001i000000yoDgy","Alpha-Delta","Kappa Sigma","Campaign Creator","Pennsylvania State University-Main Campus","Kappa Sigma","Alpha-Delta","Kappa Sigma - Alpha-Delta"  ],
                ["KS-Alpha-Eta","212kappasigma@greeks4good.com","KS1!","001i000000yoDkZ","Alpha-Eta","Kappa Sigma","Campaign Creator","George Washington University","Kappa Sigma","Alpha-Eta","Kappa Sigma - Alpha-Eta"  ],
                ["KS-Alpha-Iota","213kappasigma@greeks4good.com","KS1!","001i000000yoDiZ","Alpha-Iota","Kappa Sigma","Campaign Creator","The University of Tennessee-Chattanooga","Kappa Sigma","Alpha-Iota","Kappa Sigma - Alpha-Iota"  ],
                ["KS-Alpha-Mu","214kappasigma@greeks4good.com","KS1!","001i000000yoDkD","Alpha-Mu","Kappa Sigma","Campaign Creator","University of North Carolina at Chapel Hill","Kappa Sigma","Alpha-Mu","Kappa Sigma - Alpha-Mu"  ],
                ["KS-Alpha-Sigma","215kappasigma@greeks4good.com","KS1!","001i000000yoDjd","Alpha-Sigma","Kappa Sigma","Campaign Creator","Ohio State University-Main Campus","Kappa Sigma","Alpha-Sigma","Kappa Sigma - Alpha-Sigma"  ],
                ["KS-Alpha-Tau","216kappasigma@greeks4good.com","KS1!","001i000000yoDkS","Alpha-Tau","Kappa Sigma","Campaign Creator","Georgia Institute of Technology-Main Campus","Kappa Sigma","Alpha-Tau","Kappa Sigma - Alpha-Tau"  ],
                ["KS-Alpha-Zeta","217kappasigma@greeks4good.com","KS1!","001i000000yoDkg","Alpha-Zeta","Kappa Sigma","Campaign Creator","University of Michigan-Ann Arbor","Kappa Sigma","Alpha-Zeta","Kappa Sigma - Alpha-Zeta"  ],
                ["KS-Beta-Gamma","218kappasigma@greeks4good.com","KS1!","001i000000yoDi8","Beta-Gamma","Kappa Sigma","Campaign Creator","University of Missouri-Columbia","Kappa Sigma","Beta-Gamma","Kappa Sigma - Beta-Gamma"  ],
                ["KS-Beta-Kappa","219kappasigma@greeks4good.com","KS1!","001i000000yoDi3","Beta-Kappa","Kappa Sigma","Campaign Creator","University of New Hampshire-Main Campus","Kappa Sigma","Beta-Kappa","Kappa Sigma - Beta-Kappa"  ],
                ["KS-Beta-Psi","220kappasigma@greeks4good.com","KS1!","001i000000yoDiw","Beta-Psi","Kappa Sigma","Campaign Creator","University of Washington-Seattle Campus","Kappa Sigma","Beta-Psi","Kappa Sigma - Beta-Psi"  ],
                ["KS-Beta-Sigma","221kappasigma@greeks4good.com","KS1!","001i000000yoDi9","Beta-Sigma","Kappa Sigma","Campaign Creator","Washington University in St Louis","Kappa Sigma","Beta-Sigma","Kappa Sigma - Beta-Sigma"  ],
                ["KS-Beta-Theta","222kappasigma@greeks4good.com","KS1!","001i000000yoDiO","Beta-Theta","Kappa Sigma","Campaign Creator","Indiana University-Bloomington","Kappa Sigma","Beta-Theta","Kappa Sigma - Beta-Theta"  ],
                ["KS-Beta-Upsilon","223kappasigma@greeks4good.com","KS1!","001i000000yoDkB","Beta-Upsilon","Kappa Sigma","Campaign Creator","North Carolina State University at Raleigh","Kappa Sigma","Beta-Upsilon","Kappa Sigma - Beta-Upsilon"  ],
                ["KS-Channel-Islands","224kappasigma@greeks4good.com","KS1!","0010H00002JW1LU","California State University, Channel Islands Colony","Kappa Sigma","Campaign Creator","California State University-Channel Islands","Kappa Sigma","California State University, Channel Islands Colony","Kappa Sigma - California State University, Channel Islands Colony"  ],
                ["KS-Chi","225kappasigma@greeks4good.com","KS1!","001i000000yoDiM","Chi","Kappa Sigma","Campaign Creator","Purdue University-Main Campus","Kappa Sigma","Chi","Kappa Sigma - Chi"  ],
                ["KS-Chi-Omega","226kappasigma@greeks4good.com","KS1!","001i000000yoDkN","Chi-Omega","Kappa Sigma","Campaign Creator","University of South Carolina-Columbia","Kappa Sigma","Chi-Omega","Kappa Sigma - Chi-Omega"  ],
                ["KS-City-College","227kappasigma@greeks4good.com","KS1!","001i000001rWVLC","City College of New York Colony","Kappa Sigma","Campaign Creator","CUNY City College","Kappa Sigma","City College of New York Colony","Kappa Sigma - City College of New York Colony"  ],
                ["KS-Delta-Nu","228kappasigma@greeks4good.com","KS1!","001i000000yoDj8","Delta-Nu","Kappa Sigma","Campaign Creator","University of California-Los Angeles","Kappa Sigma","Delta-Nu","Kappa Sigma - Delta-Nu"  ],
                ["KS-Delta-Omicron","229kappasigma@greeks4good.com","KS1!","001i000000yoDjo","Delta-Omicron","Kappa Sigma","Campaign Creator","The University of Montana","Kappa Sigma","Delta-Omicron","Kappa Sigma - Delta-Omicron"  ],
                ["KS-Delta-Phi","230kappasigma@greeks4good.com","KS1!","001i000000yoDgj","Delta-Phi","Kappa Sigma","Campaign Creator","Hobart William Smith Colleges","Kappa Sigma","Delta-Phi","Kappa Sigma - Delta-Phi"  ],
                ["KS-Delta-Rho","231kappasigma@greeks4good.com","KS1!","001i000000yoDgu","Delta-Rho","Kappa Sigma","Campaign Creator","Franklin and Marshall College","Kappa Sigma","Delta-Rho","Kappa Sigma - Delta-Rho"  ],
                ["KS-Delta-Sigma","232kappasigma@greeks4good.com","KS1!","001i000000yoDfZ","Delta-Sigma","Kappa Sigma","Campaign Creator","University of Utah","Kappa Sigma","Delta-Sigma","Kappa Sigma - Delta-Sigma"  ],
                ["KS-Delta-Zeta Colony","233kappasigma@greeks4good.com","KS1!","001i000000yoDjq","Delta-Zeta Colony","Kappa Sigma","Campaign Creator","University of New Mexico-Main Campus","Kappa Sigma","Delta-Zeta Colony","Kappa Sigma - Delta-Zeta Colony"  ],
                ["KS-Rho-Rho","234kappasigma@greeks4good.com","KS1!","001i000000yoDjp","Rho-Rho","Kappa Sigma","Campaign Creator","Abraham Baldwin Agricultural College","Kappa Sigma","Rho-Rho","Kappa Sigma - Rho-Rho"  ],
                ["KS-Pi-Upsilon","235kappasigma@greeks4good.com","KS1!","001i000000yoDf4","Pi-Upsilon","Kappa Sigma","Campaign Creator","Academy of Art University","Kappa Sigma","Pi-Upsilon","Kappa Sigma - Pi-Upsilon"  ],
                ["KS-Rho","236kappasigma@greeks4good.com","KS1!","001i000000yoDjX","Rho","Kappa Sigma","Campaign Creator","Arizona State University-Tempe","Kappa Sigma","Rho","Kappa Sigma - Rho"  ],
                ["KS-Epsilon-Eta","237kappasigma@greeks4good.com","KS1!","001i000000yoDg5","Epsilon-Eta","Kappa Sigma","Campaign Creator","Bowling Green State University-Main Campus","Kappa Sigma","Epsilon-Eta","Kappa Sigma - Epsilon-Eta"  ],
                ["KS-Pi-Phi","238kappasigma@greeks4good.com","KS1!","001i000000yoDeO","Pi-Phi","Kappa Sigma","Campaign Creator","CUNY Brooklyn College","Kappa Sigma","Pi-Phi","Kappa Sigma - Pi-Phi"  ],
                ["KS-Nu-Alpha","239kappasigma@greeks4good.com","KS1!","001i000000yoDi6","Nu-Alpha","Kappa Sigma","Campaign Creator","California Polytechnic State University-San Luis Obispo","Kappa Sigma","Nu-Alpha","Kappa Sigma - Nu-Alpha"  ],
                ["KS-Omicron-Mu","240kappasigma@greeks4good.com","KS1!","001i000000yoDgV","Omicron-Mu","Kappa Sigma","Campaign Creator","California State University-Bakersfield","Kappa Sigma","Omicron-Mu","Kappa Sigma - Omicron-Mu"  ],
                ["KS-Pi-Iota","241kappasigma@greeks4good.com","KS1!","001i000000yoDf5","Pi-Iota","Kappa Sigma","Campaign Creator","California State University-Chico","Kappa Sigma","Pi-Iota","Kappa Sigma - Pi-Iota"  ],
                ["KS-Epsilon-Tau","242kappasigma@greeks4good.com","KS1!","001i000000yoDi5","Epsilon-Tau","Kappa Sigma","Campaign Creator","California State University-Fresno","Kappa Sigma","Epsilon-Tau","Kappa Sigma - Epsilon-Tau"  ],
                ["KS-Rho-Kappa","243kappasigma@greeks4good.com","KS1!","001i000000yoDeS","Rho-Kappa","Kappa Sigma","Campaign Creator","California State University-Monterey Bay","Kappa Sigma","Rho-Kappa","Kappa Sigma - Rho-Kappa"  ],
                ["KS-Rho-Delta","244kappasigma@greeks4good.com","KS1!","001i000000yoDfB","Rho-Delta","Kappa Sigma","Campaign Creator","California State University-Northridge","Kappa Sigma","Rho-Delta","Kappa Sigma - Rho-Delta"  ],
                ["KS-Nu-Lambda","245kappasigma@greeks4good.com","KS1!","001i000000yoDke","Nu-Lambda","Kappa Sigma","Campaign Creator","California State University-Sacramento","Kappa Sigma","Nu-Lambda","Kappa Sigma - Nu-Lambda"  ],
                ["KS-Omicron-Omega","246kappasigma@greeks4good.com","KS1!","001i000000yoDeF","Omicron-Omega","Kappa Sigma","Campaign Creator","California State University-Stanislaus","Kappa Sigma","Omicron-Omega","Kappa Sigma - Omicron-Omega"  ],
                ["KS-Omicron-Pi","247kappasigma@greeks4good.com","KS1!","001i000000yoDgT","Omicron-Pi","Kappa Sigma","Campaign Creator","Carleton College","Kappa Sigma","Omicron-Pi","Kappa Sigma - Omicron-Pi"  ],
                ["KS-Lambda-Chi","248kappasigma@greeks4good.com","KS1!","001i000000yoDkI","Lambda-Chi","Kappa Sigma","Campaign Creator","The College of Idaho","Kappa Sigma","Lambda-Chi","Kappa Sigma - Lambda-Chi"  ],
                ["KS-Pi-Xi","249kappasigma@greeks4good.com","KS1!","001i000000yoDfJ","Pi-Xi","Kappa Sigma","Campaign Creator","Colorado State University-Fort Collins","Kappa Sigma","Pi-Xi","Kappa Sigma - Pi-Xi"  ],
                ["KS-Sigma-Epsilon","250kappasigma@greeks4good.com","KS1!","001i000000yoDek","Sigma-Epsilon","Kappa Sigma","Campaign Creator","CUNY Hunter College","Kappa Sigma","Sigma-Epsilon","Kappa Sigma - Sigma-Epsilon"  ],
                ["KS-Kappa-Theta","251kappasigma@greeks4good.com","KS1!","001i000000yoDfx","Kappa-Theta","Kappa Sigma","Campaign Creator","Indiana University of Pennsylvania-Main Campus","Kappa Sigma","Kappa-Theta","Kappa Sigma - Kappa-Theta"  ],
                ["KS-Pi-Zeta","252kappasigma@greeks4good.com","KS1!","001i000000yoDje","Pi-Zeta","Kappa Sigma","Campaign Creator","Johnson & Wales University-Charlotte","Kappa Sigma","Pi-Zeta","Kappa Sigma - Pi-Zeta"  ],
                ["KS-Epsilon-Rho","253kappasigma@greeks4good.com","KS1!","001i000000yoDhz","Epsilon-Rho","Kappa Sigma","Campaign Creator","Kent State University at Kent","Kappa Sigma","Epsilon-Rho","Kappa Sigma - Epsilon-Rho"  ],
                ["KS-Mu-Epsilon","254kappasigma@greeks4good.com","KS1!","001i000000yoDj3","Mu-Epsilon","Kappa Sigma","Campaign Creator","Linfield College-McMinnville Campus","Kappa Sigma","Mu-Epsilon","Kappa Sigma - Mu-Epsilon"  ],
                ["KS-Gamma","255kappasigma@greeks4good.com","KS1!","001i000000yoDgI","Gamma","Kappa Sigma","Campaign Creator","Louisiana State University-Baton Rouge","Kappa Sigma","Gamma","Kappa Sigma - Gamma"  ],
                ["KS-Mu-Omicron","256kappasigma@greeks4good.com","KS1!","001i000000yoDgL","Mu-Omicron","Kappa Sigma","Campaign Creator","Louisiana State University-Shreveport","Kappa Sigma","Mu-Omicron","Kappa Sigma - Mu-Omicron"  ],
                ["KS-McGill","257kappasigma@greeks4good.com","KS1!","001i000001rUQfF","McGill University Colony","Kappa Sigma","Campaign Creator","McGill University","Kappa Sigma","McGill University Colony","Kappa Sigma - McGill University Colony"  ],
                ["KS-Mu-Rho","258kappasigma@greeks4good.com","KS1!","001i000000yoDkR","Mu-Rho","Kappa Sigma","Campaign Creator","Missouri State University-Springfield","Kappa Sigma","Mu-Rho","Kappa Sigma - Mu-Rho"  ],
                ["KS-Nu-Epsilon","259kappasigma@greeks4good.com","KS1!","001i000000yoDit","Nu-Epsilon","Kappa Sigma","Campaign Creator","New Mexico State University-Main Campus","Kappa Sigma","Nu-Epsilon","Kappa Sigma - Nu-Epsilon"  ],
                ["KS-Gamma-Psi","260kappasigma@greeks4good.com","KS1!","001i000000yoDjv","Gamma-Psi","Kappa Sigma","Campaign Creator","Oklahoma State University-Main Campus","Kappa Sigma","Gamma-Psi","Kappa Sigma - Gamma-Psi"  ],
                ["KS-Nu-Gamma","261kappasigma@greeks4good.com","KS1!","001i000000yoDgm","Nu-Gamma","Kappa Sigma","Campaign Creator","Pratt Institute-Main","Kappa Sigma","Nu-Gamma","Kappa Sigma - Nu-Gamma"  ],
                ["KS-Rho-Tau","262kappasigma@greeks4good.com","KS1!","001i000000yoDfq","Rho-Tau","Kappa Sigma","Campaign Creator","CUNY Queens College","Kappa Sigma","Rho-Tau","Kappa Sigma - Rho-Tau"  ],
                ["KS-Gamma-Upsilon","263kappasigma@greeks4good.com","KS1!","001i000000yoDgq","Gamma-Upsilon","Kappa Sigma","Campaign Creator","Rutgers University-New Brunswick","Kappa Sigma","Gamma-Upsilon","Kappa Sigma - Gamma-Upsilon"  ],
                ["KS-Kappa-Lambda","264kappasigma@greeks4good.com","KS1!","001i000000yoDgw","Kappa-Lambda","Kappa Sigma","Campaign Creator","Shippensburg University of Pennsylvania","Kappa Sigma","Kappa-Lambda","Kappa Sigma - Kappa-Lambda"  ],
                ["KS-Rho-Beta","265kappasigma@greeks4good.com","KS1!","001i000000yoDjG","Rho-Beta","Kappa Sigma","Campaign Creator","St. John's University","Kappa Sigma","Rho-Beta","Kappa Sigma - Rho-Beta"  ],
                ["KS-Rho-Sigma","266kappasigma@greeks4good.com","KS1!","001i000000yoDjO","Rho-Sigma","Kappa Sigma","Campaign Creator","St. John's University-Staten Island","Kappa Sigma","Rho-Sigma","Kappa Sigma - Rho-Sigma"  ],
                ["KS-Lambda-Psi","267kappasigma@greeks4good.com","KS1!","001i000000yoDfP","Lambda-Psi","Kappa Sigma","Campaign Creator","St. Mary's University","Kappa Sigma","Lambda-Psi","Kappa Sigma - Lambda-Psi"  ],
                ["KS-Sigma-Iota","268kappasigma@greeks4good.com","KS1!","001i000000yoDei","Sigma-Iota","Kappa Sigma","Campaign Creator","Saint Norbert College","Kappa Sigma","Sigma-Iota","Kappa Sigma - Sigma-Iota"  ],
                ["KS-Rho-Iota","269kappasigma@greeks4good.com","KS1!","001i000000yoDfE","Rho-Iota","Kappa Sigma","Campaign Creator","SUNY Cortland","Kappa Sigma","Rho-Iota","Kappa Sigma - Rho-Iota"  ],
                ["KS-Nu-Tau","270kappasigma@greeks4good.com","KS1!","001i000000yoDkm","Nu-Tau","Kappa Sigma","Campaign Creator","Stephen F Austin State University","Kappa Sigma","Nu-Tau","Kappa Sigma - Nu-Tau"  ],
                ["KS-Mu-Gamma","271kappasigma@greeks4good.com","KS1!","001i000000yoDgS","Mu-Gamma","Kappa Sigma","Campaign Creator","Texas A & M University-College Station","Kappa Sigma","Mu-Gamma","Kappa Sigma - Mu-Gamma"  ],
                ["KS-Epsilon-Epsilon","272kappasigma@greeks4good.com","KS1!","001i000000yoDiy","Epsilon-Epsilon","Kappa Sigma","Campaign Creator","The University of British Columbia","Kappa Sigma","Epsilon-Epsilon","Kappa Sigma - Epsilon-Epsilon"  ],
                ["KS-Gamma-Kappa","273kappasigma@greeks4good.com","KS1!","001i000000yoDiH","Gamma-Kappa","Kappa Sigma","Campaign Creator","University of Oklahoma-Norman Campus","Kappa Sigma","Gamma-Kappa","Kappa Sigma - Gamma-Kappa"  ],
                ["KS-Lambda","274kappasigma@greeks4good.com","KS1!","001i000000yoDiY","Lambda","Kappa Sigma","Campaign Creator","The University of Tennessee-Knoxville","Kappa Sigma","Lambda","Kappa Sigma - Lambda"  ],
                ["KS-Kappa-Epsilon","275kappasigma@greeks4good.com","KS1!","001i000000yoDhr","Kappa-Epsilon","Kappa Sigma","Campaign Creator","The University of Texas Rio Grande Valley","Kappa Sigma","Kappa-Epsilon","Kappa Sigma - Kappa-Epsilon"  ],
                ["KS-Epsilon-Mu","276kappasigma@greeks4good.com","KS1!","001i000000yoDkT","Epsilon-Mu","Kappa Sigma","Campaign Creator","University of Tulsa","Kappa Sigma","Epsilon-Mu","Kappa Sigma - Epsilon-Mu"  ],
                ["KS-Omicron-Theta","277kappasigma@greeks4good.com","KS1!","001i000000yoDhW","Omicron-Theta","Kappa Sigma","Campaign Creator","Thompson Rivers University","Kappa Sigma","Omicron-Theta","Kappa Sigma - Omicron-Theta"  ],
                ["KS-Pi-Rho","278kappasigma@greeks4good.com","KS1!","001i000000yoDeK","Pi-Rho","Kappa Sigma","Campaign Creator","University of Akron Main Campus","Kappa Sigma","Pi-Rho","Kappa Sigma - Pi-Rho"  ],
                ["KS-Epsilon-Alpha","279kappasigma@greeks4good.com","KS1!","001i000000yoDfS","Epsilon-Alpha","Kappa Sigma","Campaign Creator","University of Alberta","Kappa Sigma","Epsilon-Alpha","Kappa Sigma - Epsilon-Alpha"  ],
                ["KS-Mu-Lambda","280kappasigma@greeks4good.com","KS1!","001i000000yoDfV","Mu-Lambda","Kappa Sigma","Campaign Creator","University of Calgary","Kappa Sigma","Mu-Lambda","Kappa Sigma - Mu-Lambda"  ],
                ["KS-Mu-Delta","281kappasigma@greeks4good.com","KS1!","001i000000yoDjl","Mu-Delta","Kappa Sigma","Campaign Creator","University of California-Irvine","Kappa Sigma","Mu-Delta","Kappa Sigma - Mu-Delta"  ],
                ["KS-Rho-Omicron","282kappasigma@greeks4good.com","KS1!","001i000000yoDeU","Rho-Omicron","Kappa Sigma","Campaign Creator","University of California-Merced","Kappa Sigma","Rho-Omicron","Kappa Sigma - Rho-Omicron"  ],
                ["KS-Pi-Psi","283kappasigma@greeks4good.com","KS1!","001i000000yoDfL","Pi-Psi","Kappa Sigma","Campaign Creator","University of California-San Diego","Kappa Sigma","Pi-Psi","Kappa Sigma - Pi-Psi"  ],
                ["KS-Epsilon-Theta","284kappasigma@greeks4good.com","KS1!","001i000000yoDfe","Epsilon-Theta","Kappa Sigma","Campaign Creator","University of California-Santa Barbara","Kappa Sigma","Epsilon-Theta","Kappa Sigma - Epsilon-Theta"  ],
                ["KS-Nu-Psi","285kappasigma@greeks4good.com","KS1!","001i000000yoDiL","Nu-Psi","Kappa Sigma","Campaign Creator","University of Cincinnati-Main Campus","Kappa Sigma","Nu-Psi","Kappa Sigma - Nu-Psi"  ],
                ["KS-Omicron-Zeta","286kappasigma@greeks4good.com","KS1!","001i000000yoDh8","Omicron-Zeta","Kappa Sigma","Campaign Creator","University of Hawaii at Manoa","Kappa Sigma","Omicron-Zeta","Kappa Sigma - Omicron-Zeta"  ],
                ["KS-Omicron-Xi","287kappasigma@greeks4good.com","KS1!","001i000000yoDgX","Omicron-Xi","Kappa Sigma","Campaign Creator","University of Lethbridge","Kappa Sigma","Omicron-Xi","Kappa Sigma - Omicron-Xi"  ],
                ["KS-Gamma-Delta","288kappasigma@greeks4good.com","KS1!","001i000000yoDhw","Gamma-Delta","Kappa Sigma","Campaign Creator","University of Massachusetts-Amherst","Kappa Sigma","Gamma-Delta","Kappa Sigma - Gamma-Delta"  ],
                ["KS-Kappa-Alpha","289kappasigma@greeks4good.com","KS1!","001i000000yoDkQ","Kappa-Alpha","Kappa Sigma","Campaign Creator","University of Nevada-Las Vegas","Kappa Sigma","Kappa-Alpha","Kappa Sigma - Kappa-Alpha"  ],
                ["KS-Mu-Zeta","290kappasigma@greeks4good.com","KS1!","001i000000yoDkC","Mu-Zeta","Kappa Sigma","Campaign Creator","University of North Carolina Wilmington","Kappa Sigma","Mu-Zeta","Kappa Sigma - Mu-Zeta"  ],
                ["KS-Rho-Alpha","291kappasigma@greeks4good.com","KS1!","001i000000yoDf3","Rho-Alpha","Kappa Sigma","Campaign Creator","University of Pittsburgh-Bradford","Kappa Sigma","Rho-Alpha","Kappa Sigma - Rho-Alpha"  ],
                ["KS-Kappa-Delta","292kappasigma@greeks4good.com","KS1!","001i000000yoDkG","Kappa-Delta","Kappa Sigma","Campaign Creator","University of South Florida-Main Campus","Kappa Sigma","Kappa-Delta","Kappa Sigma - Kappa-Delta"  ],
                ["KS-Nu Prime","293kappasigma@greeks4good.com","KS1!","001i000000yoDhi","Nu Prime","Kappa Sigma","Campaign Creator","Virginia Polytechnic Institute and State University","Kappa Sigma","Nu Prime","Kappa Sigma - Nu Prime"  ],
                ["KS-Sigma-Nu","294kappasigma@greeks4good.com","KS1!","001i000000yoDeJ","Sigma-Nu","Kappa Sigma","Campaign Creator","SUNY at Binghamton","Kappa Sigma","Sigma-Nu","Kappa Sigma - Sigma-Nu"  ],
                ["KS-Sigma-Pi","295kappasigma@greeks4good.com","KS1!","001i000000yoDe7","Sigma-Pi","Kappa Sigma","Campaign Creator","SUNY at Albany","Kappa Sigma","Sigma-Pi","Kappa Sigma - Sigma-Pi"  ],
                ["KS-Sigma-Rho","296kappasigma@greeks4good.com","KS1!","001i000000yoDds","Sigma-Rho","Kappa Sigma","Campaign Creator","Southern Illinois University-Edwardsville","Kappa Sigma","Sigma-Rho","Kappa Sigma - Sigma-Rho"  ],
                ["KS-Sigma-Upsilon","297kappasigma@greeks4good.com","KS1!","001i000000yoDdx","Sigma-Upsilon","Kappa Sigma","Campaign Creator","University of California-Riverside","Kappa Sigma","Sigma-Upsilon","Kappa Sigma - Sigma-Upsilon"  ],
                ["KS-Sigma-Xi","298kappasigma@greeks4good.com","KS1!","001i000000yoDeu","Sigma-Xi","Kappa Sigma","Campaign Creator","The University of West Florida","Kappa Sigma","Sigma-Xi","Kappa Sigma - Sigma-Xi"  ],
                ["KS-SUNY-Old-Westbury","299kappasigma@greeks4good.com","KS1!","001i000001fLA8B","SUNY Old Westbury Colony","Kappa Sigma","Campaign Creator","SUNY College at Old Westbury","Kappa Sigma","SUNY Old Westbury Colony","Kappa Sigma - SUNY Old Westbury Colony"  ],
                ["KS-SUNY-Oneonta","300kappasigma@greeks4good.com","KS1!","001i000000yoDec","SUNY Oneonta Colony","Kappa Sigma","Campaign Creator","SUNY Oneonta","Kappa Sigma","SUNY Oneonta Colony","Kappa Sigma - SUNY Oneonta Colony"  ],
                ["KS-SUNY-Oswego","301kappasigma@greeks4good.com","KS1!","001i000001zPRuK","SUNY Oswego Colony","Kappa Sigma","Campaign Creator","SUNY College at Oswego","Kappa Sigma","SUNY Oswego Colony","Kappa Sigma - SUNY Oswego Colony"  ],
                ["KS-Tau-Alpha","302kappasigma@greeks4good.com","KS1!","001i000000yoDdS","Tau-Alpha","Kappa Sigma","Campaign Creator","SUNY College at Geneseo","Kappa Sigma","Tau-Alpha","Kappa Sigma - Tau-Alpha"  ],
                ["KS-Tau-Chi","303kappasigma@greeks4good.com","KS1!","001i000001D8Csa","Tau-Chi","Kappa Sigma","Campaign Creator","Fairleigh Dickinson University-Florham Campus","Kappa Sigma","Tau-Chi","Kappa Sigma - Tau-Chi"  ],
                ["KS-Tau-Delta","304kappasigma@greeks4good.com","KS1!","001i000000yoDdR","Tau-Delta","Kappa Sigma","Campaign Creator","Pace University-New York","Kappa Sigma","Tau-Delta","Kappa Sigma - Tau-Delta"  ],
                ["KS-Tau-Gamma","305kappasigma@greeks4good.com","KS1!","001i000000yoDdf","Tau-Gamma","Kappa Sigma","Campaign Creator","University of Nevada-Reno","Kappa Sigma","Tau-Gamma","Kappa Sigma - Tau-Gamma"  ],
                ["KS-Tau-Iota","306kappasigma@greeks4good.com","KS1!","001i000000yoDkr","Tau-Iota","Kappa Sigma","Campaign Creator","Farmingdale State College","Kappa Sigma","Tau-Iota","Kappa Sigma - Tau-Iota"  ],
                ["KS-Tau-Kappa","307kappasigma@greeks4good.com","KS1!","001i000000yoDej","Tau-Kappa","Kappa Sigma","Campaign Creator","Indiana University-Southeast","Kappa Sigma","Tau-Kappa","Kappa Sigma - Tau-Kappa"  ],
                ["KS-Tau-Omicron","308kappasigma@greeks4good.com","KS1!","001i000000yoDdV","Tau-Omicron","Kappa Sigma","Campaign Creator","California State University-San Marcos","Kappa Sigma","Tau-Omicron","Kappa Sigma - Tau-Omicron"  ],
                ["KS-Tau-Psi","309kappasigma@greeks4good.com","KS1!","001i000001Mh9vZ","Tau-Psi","Kappa Sigma","Campaign Creator","SUNY at Fredonia","Kappa Sigma","Tau-Psi","Kappa Sigma - Tau-Psi"  ],
                ["KS-Tau-Theta","310kappasigma@greeks4good.com","KS1!","001i000000yoDks","Tau-Theta","Kappa Sigma","Campaign Creator","West Chester University of Pennsylvania","Kappa Sigma","Tau-Theta","Kappa Sigma - Tau-Theta"  ],
                ["KS-Tau-Upsilon","311kappasigma@greeks4good.com","KS1!","001i000000yoDda","Tau-Upsilon","Kappa Sigma","Campaign Creator","York University","Kappa Sigma","Tau-Upsilon","Kappa Sigma - Tau-Upsilon"  ],
                ["KS-Tau-Zeta","312kappasigma@greeks4good.com","KS1!","001i000000yoDhN","Tau-Zeta","Kappa Sigma","Campaign Creator","Arkansas State University-Main Campus","Kappa Sigma","Tau-Zeta","Kappa Sigma - Tau-Zeta"  ],
                ["KS-Theta-Beta","313kappasigma@greeks4good.com","KS1!","001i000000yoDk5","Theta-Beta","Kappa Sigma","Campaign Creator","California State University-Long Beach","Kappa Sigma","Theta-Beta","Kappa Sigma - Theta-Beta"  ],
                ["KS-Theta-Kappa","314kappasigma@greeks4good.com","KS1!","001i000000yoDfO","Theta-Kappa","Kappa Sigma","Campaign Creator","Texas A & M University-Kingsville","Kappa Sigma","Theta-Kappa","Kappa Sigma - Theta-Kappa"  ],
                ["KS-Theta-Tau","315kappasigma@greeks4good.com","KS1!","001i000000yoDfd","Theta-Tau","Kappa Sigma","Campaign Creator","University of California-Los Angeles","Kappa Sigma","Theta-Tau","Kappa Sigma - Theta-Tau"  ],
                ["KS-Theta-Zeta","316kappasigma@greeks4good.com","KS1!","001i000000yoDis","Theta-Zeta","Kappa Sigma","Campaign Creator","Eastern New Mexico University-Main Campus","Kappa Sigma","Theta-Zeta","Kappa Sigma - Theta-Zeta"  ],
                ["KS-Upsilon-Beta","317kappasigma@greeks4good.com","KS1!","001i000000yoDdc","Upsilon-Beta","Kappa Sigma","Campaign Creator","California State University-San Bernardino","Kappa Sigma","Upsilon-Beta","Kappa Sigma - Upsilon-Beta"  ],
                ["KS-Upsilon-Eta","318kappasigma@greeks4good.com","KS1!","001i000000yoDdY","Upsilon-Eta","Kappa Sigma","Campaign Creator","University of Wisconsin-Green Bay","Kappa Sigma","Upsilon-Eta","Kappa Sigma - Upsilon-Eta"  ],
                ["KS-Upsilon-Gamma","319kappasigma@greeks4good.com","KS1!","001i000001dJ3ol","Upsilon-Gamma","Kappa Sigma","Campaign Creator","College of Staten Island CUNY","Kappa Sigma","Upsilon-Gamma","Kappa Sigma - Upsilon-Gamma"  ],
                ["KS-Xi-Nu Colony","320kappasigma@greeks4good.com","KS1!","001i000000yoDet","Xi-Nu Colony","Kappa Sigma","Campaign Creator","University of Western Ontario","Kappa Sigma","Xi-Nu Colony","Kappa Sigma - Xi-Nu Colony"  ],
                ["KS-Xi-Upsilon","321kappasigma@greeks4good.com","KS1!","001i000000yoDhB","Xi-Upsilon","Kappa Sigma","Campaign Creator","Texas A & M University-College Station","Kappa Sigma","Xi-Upsilon","Kappa Sigma - Xi-Upsilon"  ],
                ["KS-Zeta","322kappasigma@greeks4good.com","KS1!","001i000000yoDhg","Zeta","Kappa Sigma","Campaign Creator","University of Virginia-Main Campus","Kappa Sigma","Zeta","Kappa Sigma - Zeta"  ]
            ];

    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
    // exit();

    $chunk = array_chunk($data, 15);
    $ite = isset($_GET['ite']) ? $_GET['ite'] : 0;

    if(!isset($chunk[$ite])){
        echo "done";
        exit();
    }

    $d = $chunk[$ite];

    // $password = 'KS1!';
    $i = 0;
    echo "<ol>";
    foreach ($d as $key => $value) {

        $user_login = $value[0];
        $first_name = $value[8];
        $last_name = $value[9];
        $display_name = $value[10];

        $user = get_user_by( 'login', $user_login );
        // if(empty($user))
        //  continue;

        // wp_set_password( $password, $user->ID );
        // printf('<li>(%d) %s</li>', $user->ID, $user->display_name);
        
        if(empty($user)){
            printf('<li>User %s not exists</li>', $user_login);
        } else {

            $new_data = array(
                'ID' => $user->ID,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'display_name' => $display_name,
            );

            $user_id = wp_update_user( $new_data );

            if ( is_wp_error( $user_id ) ) {
                printf('<li>Failed: %s</li>', $user_id->get_error_message() );
            } else {
                echo "<li>";
                echo "<pre>";
                print_r($new_data);
                echo "</pre>";
                echo "</li>";
            }

            // printf('<li>(%d) %s</li>', $user->ID, '<pre></pre>');
        }
    }
    echo "</ol>";

    $new_ite = $ite + 1;
    if(isset($chunk[$new_ite])){

        $next = add_query_arg( array('ite' => $new_ite) );
        echo '<a href="'.$next.'">Next</a>';
        
        ?>
        <script>
            // Your application has indicated there's an error
            window.setTimeout(function(){

                // Move to a new location or you can do something else
                window.location.href = "<?php echo $next; ?>";

            }, 5000);
        </script>
        <?php
    } else {
        echo "done";
    }
    exit();

    // $x = delete_post_meta( 35521, 'salesforce_event_id' );
    // var_dump($x);
    // exit();
    
    $orgs = pp_get_connected_organizations();
    echo "<pre>";
    print_r($orgs);
    echo "</pre>";
    
    $campaign_donation_data = edd_get_payment_meta( 35603, 'charge_details', true );
    echo "<pre>";
    print_r($campaign_donation_data);
    echo "</pre>";
    exit();

    $g = get_user_meta( 516, 'crm_account_id', true );
    var_dump($g);
    exit();

    $g = get_post_meta( 35524, 'salesforce_event_id', true );
    var_dump($g);
    exit();

    $query_args = array(
        'number' => -1, // get all
        'output' => 'fundraisers',
        'distinct_fundraisers' => true,
    );

    $query_args['campaign'] = pp_get_merged_team_campaign_ids(28441);

    $x = new PP_Charitable_Fundraisers_Donor_Query( $query_args );

    echo "<pre>";
    print_r($x);
    echo "</pre>";

    exit();


    $asu = array();

    // $query_args = array(
    //     'campaign_id' => 19432,
    // );
    // $report = charitable_get_table( 'campaign_donations' )->get_donations_report( $query_args );
    // $s = PP_Reports::get_campaign_reports(19432);

    // echo "<pre>";
    // print_r($s);
    // echo "</pre>";
    // exit();

    $campaign_id = 19432;
    $donation_ids = charitable_get_table( 'campaign_donations' )->get_donation_ids_for_campaign( $campaign_id );
    $query_args['meta_query'] = array(
        array(
            'key' => 'charitable_donation_from_edd_payment',
            'value' => $donation_ids,
            'compare' => 'IN',
        ),
    );

    $extension = 'charitable-edd';
    $benefactors = charitable_get_table( 'benefactors' )->get_campaign_benefactors_by_extension($campaign_id, $extension );
    $campaign_benefactor_downloads = (!empty($benefactors)) ? wp_list_pluck( $benefactors, 'edd_download_id' ) : array();

    $payments = edd_get_payments( $query_args );

    $data = array();
    $fundraisers_details = array();
    $donation_details = array();

    $ticket_details = array();
    $ticket_qty_by_options = array();

    $merchandise_details = array();
    $merchandise_qty_by_options = array();

    $total_amount = array(
        'fundraisers' => 0,
        'donations' => 0,
        'tickets' => 0,
        'merchandises' => 0,
    );

    $total_fundraising = 0;

    foreach ($payments as $payment) {

        $edd_payment    = new EDD_Payment( $payment->ID );
        
        $downloads      = edd_get_payment_meta_cart_details( $payment->ID );
        $fees           = edd_get_payment_fees( $payment->ID, 'item' );
        $user_info      = edd_get_payment_meta_user_info( $payment->ID );
        $payment_meta   = edd_get_payment_meta( $payment->ID );


        $asu[] = get_post_meta( $payment->ID, 'charitable_donation_from_edd_payment', true );

        $donation_id    = get_post_meta( $payment->ID, 'charitable_donation_from_edd_payment', true );
        if ( ! $donation_id ) {
            continue;
        }
        $donation       = charitable_get_donation( $donation_id );
        $donor = $donation->get_donor();

        $title = str_replace(array('&#8217;', '&#8217;' ), "'", get_the_title( $campaign_id ));
        $fundraising_amount = 0;
        $report_data = array(
            'donation_id' => $donation_id,
            'campaign_id' => $campaign_id,
            'campaign_name' => $title,
            'email' => $payment_meta['email'],
            'first_name' => isset( $user_info['first_name'] ) ? $user_info['first_name'] : '',
            'last_name' => isset( $user_info['last_name'] ) ? $user_info['last_name'] : '',
            'post_date' => $donation->post_date,
            'post_content' => $donation->post_content,
            'post_status' => $donation->post_status,
            'date' => mysql2date( 'l, F j, Y', $donation->post_date ),
            'time' => mysql2date( 'H:i A', $donation->post_date ),
            'chapter' => (isset($payment_meta['chapter']) && !empty($payment_meta['chapter'])) ? $payment_meta['chapter'] : 'na',
            'referral' => (isset($payment_meta['referral']) && !empty($payment_meta['referral'])) ? $payment_meta['referral'] : 'na',
            'payment_gateway' => $edd_payment->gateway,
            'amount' => '',
            'purchase_detail' => '',
            'shipping' => 0,
            'ticket_holder' => '',
            'qty' => '',
            'type' => '',
        );

        /**
         * DONATION
         */
        if ( $fees ) {
            foreach ( $fees as $key => $fee ) {
                if ( ! Charitable_EDD_Cart::fee_is_donation( $fee ) ) {
                    continue;
                }

                if(!empty($campaign_id) && ($campaign_id != $fee['campaign_id']))
                    continue;

                $donation_data = array(
                    'type' => 'donation',
                    'amount' => edd_format_amount($fee['amount']),
                    'purchase_details' => sprintf(__('Donation for %s', 'pp-toolkit'), $title ),
                );

                /**
                 * Display as Mobile donation if donation coming from rest api
                 * @var [type]
                 */
                if($edd_payment->gateway == 'rest-api'){
                    $donation_data['purchase_details'] = sprintf(__('Mobile Donation for %s', 'pp-toolkit'), $title );
                }

                $total_amount['donations'] += $fee['amount'];
                $fundraising_amount += $fee['amount'];
                $donation_details[] = array_merge($report_data, $donation_data);
            }
        }

        /**
         * DOWNLOADS
         */
        if ( $downloads ) {
            foreach ( $downloads as $key => $download ) {
                // Download ID
                $id = isset($download['id']) ? $download['id'] : $download;
                if(!empty($campaign_id) && !in_array($id, $campaign_benefactor_downloads))
                    continue;

                // unique key for grouping
                $download_unique_key = $id;

                $download_description = get_the_title( $id );
                $options = ( isset( $download['item_number'] ) && isset( $download['item_number']['options'] ) ) ? $download['item_number']['options'] : array();

                if ( !empty($options) ) {
                    $price_id   = isset( $options['price_id'] ) ? $options['price_id'] : null;
                    if ( edd_has_variable_prices( $id ) && isset( $price_id ) ) {
                        // append unique key
                        $download_unique_key .= '-' . $price_id;

                        $download_description .= ' - ' . edd_get_price_option_name( $id, $price_id, $payment->ID );
                    }
                }

                $download_data = array(
                    'amount' => edd_format_amount($download['subtotal']),
                    'purchase_details' => $download_description,
                    'qty' => $download['quantity'],
                    'options' => $options
                );

                // ticket holder
                if (isset($options['tribe-tickets-meta']) 
                    && is_array($options['tribe-tickets-meta']) 
                    && !empty($options['tribe-tickets-meta']))
                {
                    $_ticket_holder = wp_list_pluck( $options['tribe-tickets-meta'], 'ticket-holder-name' );
                    $download_data['ticket_holder'] = implode(', ', $_ticket_holder);
                }

                $shiping_cost = 0;
                if($download['fees']):
                foreach ( $download[ 'fees' ] as $fee_id => $fee ) {
                    if ( false === strpos( $fee_id, 'simple_shipping' ) ) {
                        continue;
                    }

                    $download_data['shipping'] = (isset($fee['amount'])) ? $fee['amount'] : 0;
                    break;
                }
                endif;

                // merge with report data
                $report_data = array_merge($report_data, $download_data);

                // ticket
                if (has_term('ticket', 'download_category', $id )) {

                    $report_data['type'] = 'ticket';

                    $total_amount['tickets'] += $report_data['amount'];
                    $fundraising_amount += $report_data['amount'];

                    // count unique ids
                    if(!isset($ticket_qty_by_options[$download_unique_key])){
                        $ticket_qty_by_options[$download_unique_key] = array(
                            'name' => $download_description,
                            'qty' => $report_data['qty'],
                        );
                    } else {
                        $ticket_qty_by_options[$download_unique_key]['qty'] += $report_data['qty'];
                    }

                    $ticket_details[] = $report_data;

                } else {

                    $report_data['type'] = 'merchandise';

                    $total_amount['merchandises'] += $report_data['amount'];
                    $fundraising_amount += $report_data['amount'];

                    // count unique ids
                    if(!isset($merchandise_qty_by_options[$download_unique_key])){
                        $merchandise_qty_by_options[$download_unique_key] = array(
                            'name' => $download_description,
                            'qty' => $report_data['qty'],
                        );
                    } else {
                        $merchandise_qty_by_options[$download_unique_key]['qty'] += $report_data['qty'];
                    }

                    $merchandise_details[] = $report_data;
                }
            }
        }

        // count fundraiser
        if(!isset($fundraisers_details[$report_data['referral']])){
            $fundraisers_details[$report_data['referral']] = array(
                'name' => $report_data['referral'],
                'donations' => 1,
                'amount' => $fundraising_amount,
            );
        } else {
            $fundraisers_details[$report_data['referral']]['donations'] += 1;
            $fundraisers_details[$report_data['referral']]['amount'] += $fundraising_amount;
        }

        $total_amount['fundraisers'] += $fundraising_amount;

    }

    $data = array(
        'fundraisers' => array(
            'details' => $fundraisers_details,
            'total_amount' => $total_amount['fundraisers']
        ),
        'donations' => array(
            'details' => $donation_details,
            'total_amount' => $total_amount['donations']
        ),
        'tickets' => array(
            'details' => $ticket_details,
            'total_amount' => $total_amount['tickets'],
            'qty_by_options' => $ticket_qty_by_options,
        ),
        'merchandises' => array(
            'details' => $merchandise_details,
            'total_amount' => $total_amount['merchandises'],
            'qty_by_options' => $merchandise_qty_by_options,
        ),
    );

    echo "<pre>";
    print_r($asu);
    echo "</pre>";
    exit();

    $query_args = array(
        'campaign_id' => 19432,
    );
    $report = charitable_get_table( 'campaign_donations' )->get_donations_report( $query_args );
    $s = PP_Reports::get_campaign_reports(19432);

    echo "<pre>";
    print_r($s['merchandises']);
    echo "</pre>";
    exit();

	$campaign_id = 25264;

    $campaign_ids = array($campaign_id);

    $ca = Charitable_Ambassadors_Campaign::get_instance();
    $childrens = $ca->get_child_campaigns( $campaign_id );
    if ( !empty( $childrens ) ) {
        $campaign_ids = array_merge( $campaign_ids, $childrens );
    }
    echo "<pre>";
    print_r($campaign_ids);
    echo "</pre>";
    exit();

	$query_args = array(
		'campaign_id' => $campaign_ids,
	);
	$report = charitable_get_table( 'campaign_donations' )->get_donations_report( $query_args );

    // containers
    $donations_from_edd_log = array();
    $payment_ids = array();

    $data = array();
    $fundraisers_details = array();
    $donation_details = array();

    $ticket_details = array();
    $ticket_qty_by_options = array();

    $merchandise_details = array();
    $merchandise_qty_by_options = array();

    $total_amount = array(
        'fundraisers' => 0,
        'donations' => 0,
        'tickets' => 0,
        'merchandises' => 0,
    );

    $total_fundraising = 0;

	foreach ($report as $key => $r) {

		// echo "<hr>";

		if(!isset($payment_ids[$r->donation_id])){
			$payment_ids[$r->donation_id] = Charitable_EDD_Payment::get_payment_for_donation( $r->donation_id );
		}

		if(!isset($donations_from_edd_log[$r->donation_id])){
			$donations_from_edd_log[$r->donation_id] = get_post_meta( $r->donation_id, 'donation_from_edd_payment_log', true );
		}

		/**
		 * Payment data
		 * @var EDD_Payment
		 */
		$payment 		= new EDD_Payment( $payment_ids[$r->donation_id] );
		$payment_meta   = edd_get_payment_meta( $payment->ID );
		$downloads      = edd_get_payment_meta_cart_details( $payment->ID );
        $fees           = edd_get_payment_fees( $payment->ID, 'item' );

		// debug 
		// $r->original_log = $donations_from_edd_log[$r->donation_id];
		// $r->downloads = $downloads;
		// $r->fees = $fees;


		/**
		 * DEFAULT DATA
		 * @var [type]
		 */
		$r->purchase_detail = sprintf(__('Donation for %s', 'pp-toolkit'), $r->campaign_name );
		$r->date = mysql2date( 'l, F j, Y', $r->post_date );
        $r->time = mysql2date( 'H:i A', $r->post_date );
        $r->shipping = 0;
        $r->ticket_holder = '';
        $r->chapter = (isset($payment_meta['chapter']) && !empty($payment_meta['chapter'])) ? $payment_meta['chapter'] : 'na'; // maybe need on future
        $r->referral = (isset($payment_meta['referral']) && !empty($payment_meta['referral'])) ? $payment_meta['referral'] : 'na';
        $r->payment_gateway = $payment->gateway;

		$edd_log = false;

		/**
		 * Get matched edd log
		 */
		if(!empty($donations_from_edd_log[$r->donation_id])):
		foreach ($donations_from_edd_log[$r->donation_id] as $key => $log) {

			// check campaign id
			if($log['campaign_id'] != $r->campaign_id){
				unset($donations_from_edd_log[$r->donation_id][$key]);
				continue;
			}

			// if found
			if($r->amount == $log['amount']) {
				$edd_log = $log;
				unset($donations_from_edd_log[$r->donation_id][$key]);
				break;
			}
		}
		endif;

		if($log){
			if(isset($log['download_id']) && $downloads){

                // default item name
                $download_description = get_the_title( $log['download_id'] );
                $r->qty = 1;

                // unique key for grouping
				$download_unique_key = $log['download_id'];

				// parse download
				foreach ($downloads as $key => $d) {
					if($log['download_id'] != $d['id'] )
						continue;

                    $options = isset($d['item_number']['options']) ? $d['item_number']['options'] : array();
                    if ( isset( $d['item_number'] ) && isset( $d['item_number']['options'] ) ):
                    $price_options = $d['item_number']['options'];
                    $price_id   = isset( $d['item_number']['options']['price_id'] ) ? $d['item_number']['options']['price_id'] : null;
                    if ( edd_has_variable_prices( $log['download_id'] ) && !is_null( $price_id ) ) {
                        // append unique key
                        $download_unique_key .= '-' . $price_id;

                        // append description
                        $download_description .= ' - ' . edd_get_price_option_name( $log['download_id'], $price_id, $payment->ID );
                    }
                    endif;

                    // ticket holder
                	if (isset($options['tribe-tickets-meta']) 
                        && is_array($options['tribe-tickets-meta']) 
                        && !empty($options['tribe-tickets-meta']))
                    {
                        $_ticket_holder = wp_list_pluck( $options['tribe-tickets-meta'], 'ticket-holder-name' );
                        $r->ticket_holder = implode(', ', $_ticket_holder);
                    }

                    // shipping
                    if($d['fees']):
                    foreach ( $d[ 'fees' ] as $fee_id => $fee ) {
                        if ( false === strpos( $fee_id, 'simple_shipping' ) ) {
                            continue;
                        }

                        $r->shipping = (isset($fee['amount'])) ? $fee['amount'] : 0;
                        break;
                    }
                    endif;

                    $r->purchase_detail = $download_description;
                    $r->qty = $d['quantity'];
                    // $r->amount = $d['subtotal'];
                    break;
				}

				// ticket
                if (has_term('ticket', 'download_category', $log['download_id'] )) {

                	$r->type = 'ticket';

                    $total_amount['tickets'] += $r->amount;

                    // count unique ids
                    if(!isset($ticket_qty_by_options[$download_unique_key])){
                        $ticket_qty_by_options[$download_unique_key] = array(
                            'name' => $download_description,
                            'qty' => $r->qty,
                        );
                    } else {
                        $ticket_qty_by_options[$download_unique_key]['qty'] += $r->qty;
                    }

                    $ticket_details[] = (array) $r;

                } else {

                	$r->type = 'merchandise';

                	$total_amount['merchandises'] += $r->amount;

                	// count unique ids
                    if(!isset($merchandise_qty_by_options[$download_unique_key])){
                        $merchandise_qty_by_options[$download_unique_key] = array(
                            'name' => $download_description,
                            'qty' => $r->qty,
                        );
                    } else {
                        $merchandise_qty_by_options[$download_unique_key]['qty'] += $r->qty;
                    }

                    $merchandise_details[] = (array) $r;
                }

			} else {
				
				$r->type = 'donation';

				/**
				 * Display as Mobile donation if donation coming from rest api
		         */
		        if($payment->gateway == 'rest-api'){
		            $r->purchase_detail = sprintf(__('Mobile Donation for %s', 'pp-toolkit'), $r->campaign_name );
		        }

		        $total_amount['donations'] += $r->amount;

		        $donation_details[] = (array) $r;
			}


            // count fundraiser
            if(!isset($fundraisers_details[$r->referral])){
                $fundraisers_details[$r->referral] = array(
                    'name' => $r->referral,
                    'donations' => 1,
                    'amount' => $r->amount,
                );
            } else {
                $fundraisers_details[$r->referral]['donations'] += 1;
                $fundraisers_details[$r->referral]['amount'] += $r->amount;
            }

            $total_amount['fundraisers'] += $r->amount;

		} // endif $log
		
		// count to total fundraising for debug
		$total_fundraising += $r->amount;

	} // endforeach $report

	$data = array(
        'fundraisers' => array(
            'details' => $fundraisers_details,
            'total_amount' => $total_amount['fundraisers']
        ),
        'donations' => array(
            'details' => $donation_details,
            'total_amount' => $total_amount['donations']
        ),
        'tickets' => array(
            'details' => $ticket_details,
            'total_amount' => $total_amount['tickets'],
            'qty_by_options' => $ticket_qty_by_options,
        ),
        'merchandises' => array(
            'details' => $merchandise_details,
            'total_amount' => $total_amount['merchandises'],
            'qty_by_options' => $merchandise_qty_by_options,
        ),
    );

	echo "<pre>";
	print_r($data['fundraisers']['details']);
	echo "</pre>";
	exit();

	// global $wpdb;

	// $r = $wpdb->get_results("SELECT DISTINCT p.ID FROM wpxj_charitable_campaign_donations cd INNER JOIN wpxj_posts p ON p.ID = cd.donation_id WHERE cd.campaign_id IN ( ".$campaign_id." ) AND p.post_status IN ( 'charitable-completed' )");
	// $_ids = wp_list_pluck( $r, 'ID' );

	// $count2 = count(array_unique($_ids));
	// echo $count2 . '<br>';
 //    echo "<pre>";
 //    print_r($reports);
 //    echo "</pre>";
    exit();

	
	exit();
}