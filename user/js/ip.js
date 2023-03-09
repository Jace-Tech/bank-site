const getIp = async (name) => {
  const req = await fetch('https://ipapi.co/json/')
  const data = req.json()

  console.log(data)

  if(!data) return
  // send email
  const formData = new FormData()
  formData.append("ip", JSON.stringify(data, null, 4))
  formData.append("name", name)

  fetch("./api/sendip.php", {
    method: "POST",
    body: formData,
  })
  .then(response => response.text())
  .catch(err => console.log(err.message))
}