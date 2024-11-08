# Switchbird Single Sign-On (SSO) Example

Switchbird provides Single Sign-On (SSO) capability to Enterprise private-label customers who wish to allow their users (e.g. members, clients, customers, franchisees, staff, etc.) to seamlessly and securely log into their dashboard without being prompted for a username and password.

Once SSO is enabled for your account, your admin users will have the power to grant SSO access to any and all of your account users. Here is the basic workflow for utilizing the SSO feature:

1. Enterprise customers can request this feature by contacting support@switchbird.com.
2. Switchbird turns on the SSO feature and provides the customer with the SSO Secret. 
3. Customer develops the necessary code to generate JSON Web Tokens (JWTs) signed with the secret.
4. Customer creates login links or redirects for their users by appending signed and timestamped JWTs to the authorization URL.

## JSON Web Token

JSON Web Token (JWT) is an open standard (RFC 7519), representing a compact and self-contained way for securely transmitting information between parties as a JSON object.

JWTs can be verified and trusted because they are digitally signed. In our implementation, JWTs must be signed with the HMAC algorithm using your SSO secret.

This approach makes use of standard algorithms that are part of any cryptography library. However, there are also numerous free and open-source JWT libraries available that make generating tokens very easy.

## Example Code

This repository includes sample code for generating signed JWTs to log a user into their account using only an SSO secret and the user's email address:

- *Email:* The email address of the user you want to log in. Make sure that the email address in the JWT is identical to the user's email address in Switchbird.
- *Date:* The date on which you are submitting your request. Send the current date to avoid authorization errors.

To run the example, create a `config.php` file reflecting your authorization URL and SSO secret:

```php
const AUTH_BASE_URL = 'https://your.login-subdomain.com/sso/authorize';
const AUTH_SECRET = 'your secret';
```

Build and run the Docker image:

```sh
docker image build -t ssodemo .
docker run -it --rm -p 8080:80 -v "$PWD":/var/www/html ssodemo
```

Visit `localhost:8080` in your browser and enter a user email to generate a signin URL/link.

## Disclaimer

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS “AS IS” AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

