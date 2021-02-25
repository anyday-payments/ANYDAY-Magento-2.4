<?php
declare(strict_types=1);

namespace Anyday\PaymentAndTrack\Api\Data\Andytag;

interface PricetagInterface
{
    const NAME_INLINE_CSS       = 'inline_css';
    const NAME_PRICE            = 'price';
    const NAME_TAG_CODE         = 'tag_code';
    const NAME_CURRENCY_CODE    = 'currency_code';
    const NAME_IS_ENABLE        = 'is_enable';
    const NAME_SELECT_TAG       = 'select_tag';
    const NAME_NAME_SELECT_TAG  = 'name_select_tag';

    /**
     * Get is enable
     *
     * @return bool
     */
    public function isEnabled();

    /**
     * Get Inline css
     *
     * @return string
     */
    public function getInlineCss();

    /**
     * Get Price
     *
     * @return float
     */
    public function getPrice();

    /**
     * Get tagcode
     *
     * @return string
     */
    public function getTagCode();

    /**
     * Get Currency Code
     *
     * @return string
     */
    public function getCurrency();

    /**
     * Get is view Full Price
     *
     * @return bool
     */
    public function isViewFullPrice();

    /**
     * Get select element
     *
     * @return string
     */
    public function getSelectElement();

    /**
     * Get Name Select Element
     *
     * @return string
     */
    public function getNameSelectElement();

    /**
     * Get json string tag config
     *
     * @return string
     */
    public function getSerializedTagConfig();
}
