<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/16/2018
 * Time: 8:55 PM
 */
class Member extends NetworkBase
{
    public function getSnippet()
    {
        $content = wpautop($this->getPostMeta('snippet'));
        return $content;
    }
    public function getBioImage()
    {
        if($this->getPostMeta('bio-image') <> "") {
            return $this->getPostMeta('bio-image');
        } else {
            $uploads = wp_upload_dir();
            $path = $uploads['baseurl'];
            return $path . '/bee-icon.jpg';
        }

    }
    public function getEmail()
    {
        return $this->getPostMeta('personal-email');
    }
    public function getPhone()
    {
        return $this->getPostMeta('personal-phone');
    }
    public function getAddress()
    {
        return $this->getPostMeta('personal-address');
    }
    public function getPostcode()
    {
        return $this->getPostMeta('postcode');
    }
    public function getCompanyName1()
    {
        return $this->getPostMeta('company-name-1');
    }
    public function getLogo1()
    {
        return $this->getPostMeta('company-logo-1');
    }
    public function getWebsite1()
    {
        return $this->getPostMeta('company-website-1');
    }
    public function getCompanyPhone1()
    {
        return $this->getPostMeta('company-phone-1');
    }
    public function getCompanyEmail1()
    {
        return $this->getPostMeta('company-email-1');
    }
    public function getCompanyAddress1()
    {
        return $this->getPostMeta('company-address-1');
    }
    public function getFacebook1()
    {
        return $this->getPostMeta('company-facebook-1');
    }
    public function getInstagram1()
    {
        return $this->getPostMeta('company-instagram-1');
    }
    public function getLinkedin1()
    {
        return $this->getPostMeta('company-linkedin-1');
    }
    public function getTwitter1()
    {
        return $this->getPostMeta('company-twitter-1');
    }
    public function getCompanyName2()
    {
        return $this->getPostMeta('company-name-2');
    }
    public function getLogo2()
    {
        return $this->getPostMeta('company-logo-2');
    }
    public function getCompanyPhone2()
    {
        return $this->getPostMeta('company-phone-2');
    }
    public function getCompanyEmail2()
    {
        return $this->getPostMeta('company-email-2');
    }
    public function getWebsite2()
    {
        return $this->getPostMeta('company-website-2');
    }
    public function getCompanyAddress2()
    {
        return $this->getPostMeta('company-address-2');
    }
    public function getFacebook2()
    {
        return $this->getPostMeta('company-facebook-2');
    }
    public function getInstagram2()
    {
        return $this->getPostMeta('company-instagram-2');
    }
    public function getTwitter2()
    {
        return $this->getPostMeta('company-twitter-2');
    }
    public function getLinkedin2()
    {
        return $this->getPostMeta('company-linkedin-2');
    }
    public function getCompanyName3()
    {
        return $this->getPostMeta('company-name-3');
    }
    public function getLogo3()
    {
        return $this->getPostMeta('company-logo-3');
    }
    public function getCompanyPhone3()
    {
        return $this->getPostMeta('company-phone-3');
    }
    public function getCompanyAddress3()
    {
        return $this->getPostMeta('company-address-3');
    }
    public function getWebsite3()
    {
        return $this->getPostMeta('company-website-3');
    }
    public function getCompanyEmail3()
    {
        return $this->getPostMeta('company-email-3');
    }
    public function getFacebook3()
    {
        return $this->getPostMeta('company-facebook-3');
    }
    public function getInstagram3()
    {
        return $this->getPostMeta('company-instagram-3');
    }
    public function getTwitter3()
    {
        return $this->getPostMeta('company-twitter-3');
    }
    public function getLinkedin3()
    {
        return $this->getPostMeta('company-linkedin-3');
    }
    public function getRegistrationID()
    {
        return $this->getPostMeta('registration-id');
    }
    public function getRegistrationDate()
    {
        return $this->getPostMeta('registration-date');
    }
    public function isFeatured()
    {
        if($this->getPostMeta('feature-member') == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function isApproved()
    {
        if($this->getPostMeta('member-approved') == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function getContactDetails()
    {
        $html = '
        <ul>
            <li>
                <label>Phone</label>';
                if($this->getPhone() <> "") {
                    $html .= '<a href="tel:' . formatPhoneNumber($this->getPhone()) . '">' . $this->getPhone() . '</a>';
                }
            $html .= '    
            </li>
            <li>
                <label>Website</label>';
                if($this->getWebsite() <> "") {
                    $html .= '<a href="' . formaturl($this->getWebsite()) . '" target="_blank">' . $this->getWebsite() . '</a>';
                }
            $html .= '    
            </li>
            <li>
                <label>Email</label>';
                if($this->getEmail() <> "") {
                    $html .= '<a href="mailto:' . $this->getEmail() . '">' . $this->getEmail() . '</a>';
                }
            $html .= '    
            </li>
            <li>
                <label>Social</label>';
                if($this->getFacebook() <> "") {
                    $html .= '<a href="' . $this->getFacebook() . '" target="_blank"><span class="fa fa-facebook-square"></span></a>';
                }
                if($this->getInstagram() <> "") {
                    $html .= '<a href="' . $this->getInstagram() . '" target="_blank"><span class="fa fa-instagram"></span></a>';
                }
            $html .= '    
            </li>
            <li>
                <label>Address</label>';
                if($this->getAddress() <> "") {
                    $html .= '<address>' . $this->getAddress() . '</address>';
                }
            $html .= '    
            </li>    
        </ul>';

        return $html;
    }
    public function subscriptionExpired()
    {
        if(strtotime($this->getRegistrationDate()) <= strtotime(('-1 year'))) {
            return true;
        } else {
            return false;
        }
    }

}