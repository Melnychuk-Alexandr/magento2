<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\ReleaseNotification\Test\Constraint;

use Magento\Backend\Test\Page\Adminhtml\Dashboard;
use Magento\Mtf\Constraint\AbstractConstraint;

/**
 * Assert that Release Notification Popup is visible on dashboard
 */
class AssertReleaseNotificationPopupExist extends AbstractConstraint
{
    /**
     * Assert that release notificationt popup is visible on dashboard
     *
     * @param Dashboard $dashboard
     * @return void
     */
    public function processAssert(Dashboard $dashboard, string $releaseContentVersion)
    {
        $currVersion = str_replace('Magento ver.', '', $dashboard->getApplicationVersion()->getVersion());
        $value = version_compare(
            $currVersion,
            $releaseContentVersion,
            '<='
        );

        if (!$value) {
            \PHPUnit_Framework_Assert::assertTrue(
                $dashboard->getReleaseNotificationBlock()->isVisible(),
                "Release Notification Popup is absent on dashboard."
            );
        }
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return "Release Notification Popup is visible on dashboard.";
    }
}
