<?php
$member = new Member($post);
//$companyname = $member->getCompanyName();
//if($member->getSlogan() <> "") $companyname .= ' - ' . $member->getSlogan();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-3">
                <div class="image-wrapper">
                    <img src="<?=$member->getBioImage()?>" alt="<?=$member->getTitle()?>" />
                </div>
            </div>
            <div class="col-xs-12 col-sm-9 details-wrapper">
                <h1><?=$member->getTitle()?></h1>
                <h2><?=$member->getSnippet()?></h2>
                <div class="bio-wrapper"><?=$member->getContent()?></div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 company-details-wrapper">
                <div class="image-wrapper">
                    <img src="<?=$member->getLogo1()?>" alt="<?=$member->getCompanyName1()?>" />
                </div>
                <ul>
                    <li><label>Phone</label><a href="tel:<?=formatPhoneNumber($member->getCompanyPhone1())?>"><?=$member->getCompanyPhone1()?></a></li>
                    <li><label>Website</label><a href="<?=formaturl($member->getWebsite1())?>" target="_blank"><?=$member->getWebsite1()?></a></li>
                    <li><label>Email</label><a href="mailto:<?=$member->getCompanyEmail1()?>"><?=$member->getCompanyEmail1()?></a></li>
                    <li class="social-wrapper">
                        <label>Social</label>
                        <?php if($member->getFacebook1() <> "") { ?>
                            <a href="<?=$member->getFacebook1()?>" target="_blank"><span class="fa fa-facebook-square"></span></a>
                        <?php } if($member->getInstagram1() <> "") { ?>
                            <a href="<?=$member->getInstagram1()?>" target="_blank"><span class="fa fa-instagram"></span></a>
                        <?php } if($member->getTwitter1() <> "") { ?>
                            <a href="<?=$member->getTwitter1()?>" target="_blank"><span class="fa fa-twitter-square"></span></a>
                        <?php } if($member->getLinkedIn1() <> "") { ?>
                            <a href="<?=$member->getLinkedIn1()?>" target="_blank"><span class="fa fa-linkedin-square"></span></a>
                        <?php } ?>
                    </li>
                    <li><label>Address</label><?=$member->getCompanyAddress1()?></li>
                </ul>
            </div>
            <?php
            if($member->getCompanyName2()<> "") {
            ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 company-details-wrapper">
                <div class="image-wrapper">
                    <img src="<?= $member->getLogo2() ?>" alt="<?= $member->getCompanyName2() ?>"/>
                </div>
                <ul>
                    <li><label>Phone</label><a
                                href="tel:<?= formatPhoneNumber($member->getCompanyPhone2()) ?>"><?= $member->getCompanyPhone2() ?></a>
                    </li>
                    <li><label>Website</label><a href="<?= formaturl($member->getWebsite2()) ?>"
                                                 target="_blank"><?= $member->getWebsite2() ?></a></li>
                    <li><label>Email</label><a
                                href="mailto:<?= $member->getCompanyEmail2() ?>"><?= $member->getCompanyEmail2() ?></a>
                    </li>
                    <li class="social-wrapper">
                        <label>Social</label>
                        <?php if ($member->getFacebook2() <> "") { ?>
                            <a href="<?= $member->getFacebook2() ?>" target="_blank"><span
                                        class="fa fa-facebook-square"></span></a>
                        <?php }
                        if ($member->getInstagram2() <> "") { ?>
                            <a href="<?= $member->getInstagram2() ?>" target="_blank"><span
                                        class="fa fa-instagram"></span></a>
                        <?php }
                        if ($member->getTwitter2() <> "") { ?>
                            <a href="<?= $member->getTwitter2() ?>" target="_blank"><span
                                        class="fa fa-twitter-square"></span></a>
                        <?php }
                        if ($member->getLinkedIn2() <> "") { ?>
                            <a href="<?= $member->getLinkedIn2() ?>" target="_blank"><span
                                        class="fa fa-linkedin-square"></span></a>
                        <?php } ?>
                    </li>
                    <li><label>Address</label><?= $member->getCompanyAddress2() ?></li>
                </ul>
            </div>
            <?php
            }
            if($member->getCompanyName3() <> "") {
            ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 company-details-wrapper">
                <div class="image-wrapper">
                    <img src="<?= $member->getLogo3() ?>" alt="<?= $member->getCompanyName3() ?>"/>
                </div>
                <ul>
                    <li><label>Phone</label><a
                                href="tel:<?= formatPhoneNumber($member->getCompanyPhone3()) ?>"><?= $member->getCompanyPhone3() ?></a>
                    </li>
                    <li><label>Website</label><a href="<?= formaturl($member->getWebsite3()) ?>"
                                                 target="_blank"><?= $member->getWebsite3() ?></a></li>
                    <li><label>Email</label><a
                                href="mailto:<?= $member->getCompanyEmail3() ?>"><?= $member->getCompanyEmail3() ?></a>
                    </li>
                    <li class="social-wrapper">
                        <label>Social</label>
                        <?php if ($member->getFacebook3() <> "") { ?>
                            <a href="<?= $member->getFacebook3() ?>" target="_blank"><span
                                        class="fa fa-facebook-square"></span></a>
                        <?php }
                        if ($member->getInstagram3() <> "") { ?>
                            <a href="<?= $member->getInstagram3() ?>" target="_blank"><span
                                        class="fa fa-instagram"></span></a>
                        <?php }
                        if ($member->getTwitter3() <> "") { ?>
                            <a href="<?= $member->getTwitter3() ?>" target="_blank"><span
                                        class="fa fa-twitter-square"></span></a>
                        <?php }
                        if ($member->getLinkedIn3() <> "") { ?>
                            <a href="<?= $member->getLinkedIn3() ?>" target="_blank"><span
                                        class="fa fa-linkedin-square"></span></a>
                        <?php } ?>
                    </li>
                    <li><label>Address</label><?= $member->getCompanyAddress3() ?></li>
                </ul>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</article>