# com.skvare.onlinepage

![Screenshot](/images/online_page_restrict.png)

## Overview

The Online Page Access Control extension provides CiviCRM administrators with granular control over which online pages are visible to anonymous (non-logged-in) users. This extension is essential for organizations that need to restrict access to sensitive forms, contribution pages, event registrations, or membership signup pages while maintaining public access to selected content.

**Key Features:**
- Control visibility of contribution pages for anonymous users
- Restrict event registration/donation/membership pages to authenticated users only

## Use Cases

This extension is particularly valuable for:
- **Member-Only Content:** Restricting donation forms or events to existing members
- **Private Events:** Limiting event registration to invited participants only
- **Staged Launches:** Hiding pages during development or before public launch
- **Premium Access:** Creating member-exclusive content and forms
- **Data Security:** Protecting forms that collect sensitive information

## Requirements

- **PHP:** v7.2 or higher
- **CiviCRM:** 5.4 or higher
- **Permissions:** Administrative access to manage online pages
- **CMS Integration:** Works with Drupal, WordPress, Joomla, and Backdrop

## Installation (Web UI)

Learn more about installing CiviCRM extensions in the [CiviCRM Sysadmin Guide](https://docs.civicrm.org/sysadmin/en/latest/customize/extensions/).

## Installation (CLI, Zip)

Sysadmins and developers may download the `.zip` file for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
cd <extension-dir>
cv dl com.skvare.onlinepage@https://github.com/skvare/com.skvare.onlinepage/archive/master.zip
```

## Installation (CLI, Git)

Sysadmins and developers may clone the [Git](https://en.wikipedia.org/wiki/Git) repo for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
git clone https://github.com/skvare/com.skvare.onlinepage.git
cv en onlinepage
```

## Configuration

After installation, configure the extension settings:

Use the main settings page for bulk operations:

1. **Go to:** `/civicrm/admin/onlinepagesetting`
2. **Select pages** : Event/Contribution/Membership.
3. Create message to display when somebody access page.
4. **Save changes**

## Support and Contributing

- **Issues:** Report bugs and feature requests on [GitHub Issues](https://github.com/Skvare/com.skvare.onlinepage/issues)
- **Documentation:** Additional guides available in the project wiki
- **Contributing:** Pull requests welcome! Please follow CiviCRM coding standards
- **Community Support:** Join discussions on [CiviCRM Chat](https://chat.civicrm.org)

## License

This extension is licensed under [AGPL-3.0](LICENSE.txt).

## Credits

Developed by [Skvare, LLC](https://skvare.com/contact) for the CiviCRM community.

## About Skvare

Skvare LLC specializes in CiviCRM development, Drupal integration, and providing technology solutions for nonprofit organizations, professional societies, membership-driven associations, and small businesses. We are committed to developing open source software that empowers our clients and the wider CiviCRM community.

**Contact Information**:
- Website: [https://skvare.com](https://skvare.com)
- Email: info@skvare.com
- GitHub: [https://github.com/Skvare](https://github.com/Skvare)

## Support

[Contact us](https://skvare.com/contact) for support or to learn more.

---

## Related Extensions

You might also be interested in other Skvare CiviCRM extensions:

- **Database Custom Field Check**: Prevents adding custom fields when table limits are reached
- **Image Resize**: Resize images uploaded to CiviCRM with different dimensions
- **Registration Button Label**: Customize button labels on event registration pages

For a complete list of our open source contributions, visit our [GitHub organization page](https://github.com/Skvare).
