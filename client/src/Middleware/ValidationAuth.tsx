import { useNavigate } from 'react-router-dom';
import Cookies from 'js-cookie';
import { useEffect } from 'react';

const ValidationAuth = (Component: any) => {
  return (props: any) => {
    const navigate = useNavigate();

    useEffect(() => {
      const authToken = Cookies.get('auth-token');

      if (!authToken) {
        navigate('/');
      } else {
        const apiUrl = import.meta.env.VITE_APP_API_URL;

        fetch(`${apiUrl}/validetk`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ usertk: authToken }),
        })
          .then((res) => res.json())
          .then((data) => {
            if (!data.isValid) {
              navigate('/signin');
            }
          })
          .catch((error) => {
            console.error('Error validating token:', error);
            navigate('/signin');
          });
      }
    }, [navigate]);

    return <Component {...props} />;
  };
};

export default ValidationAuth;
